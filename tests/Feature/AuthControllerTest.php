<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->postJson("/api/auth/register", [
            'username'      =>  "Test",
            'email'         =>  "test@example.com",
            'password'      =>  "12345678",
            'first_name'    =>  "Tester",

        ])
    }
}
