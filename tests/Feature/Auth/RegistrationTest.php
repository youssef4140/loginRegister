<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456A_',
            'password_confirmation' => '123456A_',
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
}
