<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DateTest extends MyTestCase
{
    public function test_dates_no_session()
    {
        $response = $this->get('/dates');
        $response->assertStatus(302);
    }

    public function test_dates_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/dates');

        $response->assertStatus(302);
    }

    public function test_dates_admin_session_role_24()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"24"%')->first();
        $response = $this->actingAs($user)
            ->withSession(['semester' => 'Spring 2020'])
            ->get('/dates');
        $response->assertStatus(200);
    }

    public function test_dates_admin_session_role_not_24()
    {
        $user = User::where('admin', 1)->where('access', 'not like', '%"24"%')->first();
        $response = $this->actingAs($user)
            ->withSession(['semester' => 'Spring 2020'])
            ->get('/dates');
        $response->assertStatus(302);
    }

    public function test_dates_update_no_session()
    {
        $response = $this->post('/dates');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_dates_update_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/dates');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_dates_update_admin_session_role_not_24()
    {
        $user = User::where('admin', 1)->where('access', 'not like', '%"24"%')->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession(['semester' => 'Spring 2020'])
            ->post('/dates');

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }
}
