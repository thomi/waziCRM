<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait Collectable
{
    /**
     * Returns a JSON success instance.
     *
     * @param mixed $data
     * @param string $code
     * @return Illuminate\Http\JsonResponse
     *
     */
    protected function JsonResponse($data, $code)
    {
        $header = ['Access-Control-Allow-Origin' => 'http://localhost:8080'];

        return response()
        ->json(['data' => $data, 'code' => $code], $code, $header);
    }

    /**
     * Returns a JSON message instance.
     *
     * @param mixed $data
     * @param string $code
     * @return Illuminate\Http\JsonResponse
     *
     */
    protected function JsonMessage($data, $code)
    {
        return response()
        ->json(['data' => ['message' => $data], 'code' => $code], $code);
    }


    /**
     * Returns a JSON error message instance.
     *
     * @param mixed $message
     * @param string $code
     * @return Illuminate\Http\JsonResponse
     *
     */
    protected function JsonError($message, $code)
    {
        return response()
        ->json(['error' => ['message' => $message], 'code' => $code], $code);
    }

    /**
     * Returns an eloquent collection instance.
     *
     * @param Illuminate\Database\Eloquent\Collection $collection
     * @param string $code
     * @return Illuminate\Database\Eloquent\Collection
     *
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->JsonResponse($collection, $code);
    }

    /**
     * Returns a single model instance.
     *
     * @param Illuminate\Database\Eloquent\Model $instance
     * @param string $code
     * @return Illuminate\Database\Eloquent\Model
     *
     */
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->JsonResponse($instance, $code);
    }
}