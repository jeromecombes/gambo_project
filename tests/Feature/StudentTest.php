<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
/**
        $this->middleware('auth');
        $this->middleware('semester');

        // Student form
        $this->middleware('old.session')->only('student_form');
        $this->middleware('old.student')->only('student_form');
        $this->middleware('student.list')->only('student_form');
        $this->middleware('this.student')->only('student_form');
        $this->middleware('role:2|7')->only('student_form');

*/

class StudentTest extends MyTestCase
{
    public function test_student_no_session()
    {
        $response = $this->get('/student');
        $response->assertStatus(302);
    }

    public function test_student_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/student');

        $response->assertStatus(200);
    }

    public function test_student_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/student');

        $response->assertStatus(200);
    }

    public function test_student_with_id_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/student/' . $student->id);

        $response->assertStatus(200);
    }

    public function test_student_with_id_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/student/' . $student->id);

        $response->assertStatus(200);
    }

    public function test_student_update_no_session()
    {
        $response = $this->post('/student');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

}
