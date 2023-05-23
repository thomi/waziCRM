<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessTokenController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['create','store']);
    }

    /**
     * Stores a new User Resource and issues an accessToken.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function create(RegisterUserRequest $request)
    {
        
        $user = User::create($request->validated());                         
        $token = $user->createToken('token');               

        $data['user'] = new UserResource($user);
        $data['access_token'] = $token->plainTextToken;                                   

        return $this->jsonResponse($data, 201);                          
    }

    /**
     * Issues a new accessToken resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email_address' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email_address', $request->email_address)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->jsonError(trans('auth.failed'), 401);
        }
        $token = $user->createToken('token');

        $data['user'] = new UserResource($user);
        $data['access_token'] = $token->plainTextToken;

        return $this->jsonResponse($data, 200);
    }

    /**
     * Revokes the specified accessToken resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->jsonMessage(trans('messages.revoked'), 200);
    }
}
