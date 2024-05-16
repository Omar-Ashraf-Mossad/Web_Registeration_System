<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testEnglish()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Register');
        $response->assertSee('Email');
    }
}
