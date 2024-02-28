<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TodoStoreRequest;
use App\Http\Requests\Api\TodoUpdateRequest;
use App\Http\Resources\Api\TodoResource;
use App\Models\Todo;
use App\Services\Contracts\TodoServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TodoController extends Controller
{
    public function __construct(private readonly TodoServiceInterface $todoService)
    {

    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $todos = $this->todoService->index();
        return response()->json(TodoResource::collection($todos));
    }

    /**
     * @param TodoStoreRequest $request
     * @return JsonResponse
     */
    public function store(TodoStoreRequest $request): JsonResponse
    {
        $todo = $this->todoService->store($request);
        return response()->json(new TodoResource($todo));
    }

    /**
     * @param TodoUpdateRequest $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(TodoUpdateRequest $request, Todo $todo): JsonResponse
    {
        $todo = $this->todoService->update($request, $todo);
        return response()->json(new TodoResource($todo));
    }
}
