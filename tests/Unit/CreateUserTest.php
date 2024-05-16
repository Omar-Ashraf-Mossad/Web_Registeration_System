<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\AuthManager;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    protected $authManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authManager = new AuthManager();
    }

    /** @test */
    public function it_registers_a_user()
    {
        $userData = [
            'fullName' => 'ahmed hossam',
            'userName' => 'ahmedhossam',
            'email' => 'ahmed@google.com',
            'birthDate' => '2002-06-07',
            'address' => '123 Main St',
            'phone' => '01112345678',
            'password' => 'password123@',
        ];

        $request = new \Illuminate\Http\Request($userData);

        $response = $this->authManager->registerUser($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseHas('users', [
            'full_name' => 'ahmed hossam',
            'user_name' => 'ahmedhossam',
            'email' => 'ahmed@google.com',
            'phone' => '01112345678',
            'address' => '123 Main St',
            'birthdate' => '2002-06-07',
        ]);
    }
}
