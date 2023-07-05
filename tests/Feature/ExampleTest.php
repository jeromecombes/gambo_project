<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends MyTestCase
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
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                '2FAVerified' => true,
                'semester' => $student->semester,
            ])->get('/');
        $response->assertStatus(200);
    }
}
