<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_no_session()
    {
        $response = $this->get('/admin2');

        $response->assertStatus(302);
    }

    public function test_admin_student_session()
    {
        $user = User::whereNull('access')->first();

        $response = $this->withSession([
            'access' => [],
            'login_name' => $user->lastname . ' ' . $user->firstname,
            'student' => 741,
            'semester' => 'Spring 2020',
            'student_name' => $user->lastname . ' ' . $user->firstname,
            ])
            ->get('/admin2');

        $response->assertStatus(302);
    }

    public function test_admin_admin_session()
    {
        $user = User::whereNotNull('access')->first();
        $response = $this->actingAs($user)
            ->withSession([
                'access' => $user->access,
                'admin' => true,
                'login_name' => $user->lastname . ' ' . $user->firstname,
                'login_univ' => $user->university,
                ])
            ->get('/admin2');

        $response->assertStatus(500);
    }

    public function test_courses_no_session()
    {
        $response = $this->get('/courses');

        $response->assertStatus(302);
    }

    public function test_courses_student_session()
    {
        $user = User::whereNull('access')->first();

        $response = $this->actingAs($user)
            ->get('/courses');

        $response->assertStatus(500);
    }

    public function test_courses_admin_session()
    {
        $user = User::whereNotNull('access')->first();
        $response = $this->actingAs($user)
            ->withSession([
                'access' => $user->access,
                'admin' => true,
                'login_name' => $user->lastname . ' ' . $user->firstname,
                'login_univ' => $user->university,
                ])
            ->get('/courses');

        $response->assertStatus(500);
    }
}
