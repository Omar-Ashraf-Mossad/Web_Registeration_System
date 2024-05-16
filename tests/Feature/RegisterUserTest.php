<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $formData = [
            'fullName' => 'ahmed hossam',
            'userName' => 'ahmedhossam',
            'email' => 'ahmed@google.com',
            'birthDate' => '2002-06-07',
            'address' => '123 Main St',
            'phone' => '01112345678',
            'password' => 'password123@',
            'password_confirmation' => 'Password123@',
        ];

        $response = $this->post('/register', $formData);

        $response = $this->followRedirects($response);

        $response->assertSee('insertion performed successfully');
    }
}
