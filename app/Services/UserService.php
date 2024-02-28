<?php

namespace App\Services;


use App;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Throwable;

class UserService implements UserServiceInterface
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
     * @param RegisterRequest $request
     * @return array
     * @throws Throwable
     */
    public function register(RegisterRequest $request): array
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            DB::commit();
            return [
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ];
        }catch (Throwable $exception){
            DB::rollBack();
            throw $exception;
        }

    }

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request): array
    {
        if(Auth::attempt($request->only(['email', 'password']))){
            $user = User::where('email', $request->email)->first();
            return [
                'user' => $user,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ];
        }
        return [];
    }
}
