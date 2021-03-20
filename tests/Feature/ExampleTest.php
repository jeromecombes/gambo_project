<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home_no_session()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_home_student_session()
    {
        $user = User::whereNull('access')->first();

        $response = $this->actingAs($user)
            ->get('/');

        $response->assertStatus(200);
    }
}
