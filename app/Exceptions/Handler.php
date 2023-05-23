<?php

namespace App\Exceptions;

use App\Traits\Collectable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Exceptions\BackedEnumCaseNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Collectable;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        $response = $this->handleException($request, $exception);
        return $response;
    }

    /**
     * Return a response based on type of error encountered
     */
    public function handleException($request, Throwable $exception)
    {

        return match (true) {
            $exception instanceof ValidationException =>
            $this->convertValidationExceptionToResponse($exception, $request),

            $exception instanceof NotFoundHttpException =>
            $this->JsonError(trans('errors.NotFound'), 404),

            $exception instanceof ModelNotFoundException =>
            $this->JsonError(trans('errors.ModelNotFound',
            ['modelName' => strtolower(class_basename($exception->getModel()))]
            ), 404),

            $exception instanceof AuthenticationException =>
            $this->unauthenticated($request, $exception),

            $exception instanceof AuthorizationException =>
            $this->JsonError($exception->getMessage(), 403),

            $exception instanceof MethodNotAllowedHttpException =>
            $this->JsonError(trans('errors.MethodNotAllowed'), 405),

            $exception instanceof HttpException =>
            $this->JsonError($exception->getMessage(), $exception->getStatusCode()),

            $exception instanceof RecordsNotFoundException =>
            new NotFoundHttpException('', $exception) &&
                $this->JsonError(trans('errors.NotFound'), 404),

            $exception instanceof SuspiciousOperationException =>
            new NotFoundHttpException('', $exception) &&
                $this->JsonError(trans('errors.NotFound'), 404),

            $exception instanceof BackedEnumCaseNotFoundException =>
            new NotFoundHttpException('', $exception) &&
                $this->JsonError(trans('errors.NotFound'), 404),

            default =>  $this->prepareJsonResponse($request, $exception),
        };
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->JsonError($errors, 422);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->JsonError(trans('errors.AuthError'), 401);
    }
}
