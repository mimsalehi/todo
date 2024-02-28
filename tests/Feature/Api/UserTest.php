<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic registration test example.
     */
    public function test_user_register(): void
    {
        $response = $this->post(route('user.register'), [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'user' => [
                    "name",
                    "email"
                ],
                "token"
            ]
        );
    }

}
