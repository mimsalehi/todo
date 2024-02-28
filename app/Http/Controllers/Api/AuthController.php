<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends Controller
{

    public function __construct(private readonly UserServiceInterface $userService)
    {

    }

    /**
     * @param LoginRequest $loginRequest
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $result = $this->userService->login($loginRequest);
        if(!isset($result['user'])){
            return response()->json([
                'error' => 'User not found!'
            ]);
        }
        return response()->json([
            'user' => new UserResource($result['user']),
            'token' => $result['token']
        ]);
    }

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $result = $this->userService->register($registerRequest);
        if(!$result){
            return response()->json([
                'error' => 'The server has error, Please try again!'
            ]);
        }
        return response()->json([
            'user' => new UserResource($result['user']),
            'token' => $result['token']
        ]);
    }
}
