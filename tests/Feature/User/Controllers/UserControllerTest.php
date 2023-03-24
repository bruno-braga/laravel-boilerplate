<?php

namespace Tests\Feature\User\Controllers;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(404);
    }
}
