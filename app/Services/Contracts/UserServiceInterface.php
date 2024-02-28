<?php


namespace App\Services\Contracts;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

interface UserServiceInterface
{
    /**
     * @param RegisterRequest $request
     * @return array|mixed
     * @throws BindingResolutionException|Throwable
     */
    public function register(RegisterRequest $request): mixed;

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request): array;

}
