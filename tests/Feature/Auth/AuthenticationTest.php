<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '123456A_',
        ]);


        $response->assertStatus(200);

        

        $responseData = $response->json();

        $this->assertArrayHasKey('user', $responseData);
        $this->assertArrayHasKey('token', $responseData);

        $userData = $responseData["user"];

        $this->assertArrayHasKey('name', $userData);
        $this->assertArrayHasKey('email', $userData);
        $this->assertArrayHasKey('id', $userData);

        $this->assertAuthenticated();

    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }


}
