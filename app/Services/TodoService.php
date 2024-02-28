<?php

namespace App\Services;


use App;
use App\Events\TodoUpdated;
use App\Http\Requests\Api\TodoStoreRequest;
use App\Http\Requests\Api\TodoUpdateRequest;
use App\Models\Todo;
use App\Models\User;
use App\Services\Contracts\TodoServiceInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class TodoService implements TodoServiceInterface
{

    /**
     * @var Authenticatable|User
     */
    protected Authenticatable|User $user;

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function index(): Collection|array|\Illuminate\Database\Eloquent\Collection
    {
        return Todo::withTrashed()->where('user_id', auth()->id())->get();
    }

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function store(TodoStoreRequest $request): Todo
    {
        $request->merge(["user_id" => auth()->id()]);
        DB::beginTransaction();
        try {
            $todo = Todo::create($request->all());
            DB::commit();
            return $todo;
        }catch (Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function update(TodoUpdateRequest $request, Todo $todo): Todo
    {
        DB::beginTransaction();
        try {
            $todo->completed = $request->completed;
            $todo->save();
            event(new TodoUpdated($todo));
            DB::commit();
            return $todo;
        }catch (Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
}
