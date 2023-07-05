<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends MyTestCase
{
    public function test_admin_no_session()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }

    public function test_admin_student_session()
    {
        $user = User::where('admin', 0)->first();
        $response = $this->actingAs($user)
            ->withSession(['2FAVerified' => true])
            ->get('/admin');
        $response->assertStatus(302);
    }

    public function test_admin_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $response = $this->actingAs($user)
            ->withSession(['2FAVerified' => true])
            ->get('/admin');
        $response->assertStatus(200);
    }

    public function test_courses_no_session()
    {
        $response = $this->get('/courses');
        $response->assertStatus(302);
    }

    public function test_courses_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                '2FAVerified' => true,
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/courses');
        $response->assertStatus(200);
    }

    public function test_courses_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                '2FAVerified' => true,
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/courses');
        $response->assertStatus(200);
    }
}
