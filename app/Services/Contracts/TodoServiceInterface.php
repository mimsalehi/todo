<?php


namespace App\Services\Contracts;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\TodoStoreRequest;
use App\Http\Requests\Api\TodoUpdateRequest;
use App\Models\Todo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

interface TodoServiceInterface
{
    /**
     * @return mixed
     */
    public function index(): mixed;

    /**
     * @param TodoStoreRequest $request
     * @return Todo
     */
    public function store(TodoStoreRequest $request): Todo;

    /**
     * @param TodoUpdateRequest $request
     * @param Todo $todo
     * @return Todo
     */
    public function update(TodoUpdateRequest $request, Todo $todo): Todo;
}
