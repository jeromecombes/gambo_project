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
        $this->middleware('student.list')->only('student_form');
        $this->middleware('this.student')->only('student_form');
        $this->middleware('role:2|7')->only('student_form');

        // Accept terms : students only
        $this->middleware('not.admin')->only('accept_terms');

        // Update form : student or admin with role 7
        $this->middleware('role:7')->only('student_form_update');

        // Admin index and requests : admin with role 2 or 7
        $this->middleware('admin')->only(['index', 'requests']);
        $this->middleware('role:2|7')->only(['index', 'requests']);

        // Assignment : admin with role 7
        $this->middleware('admin')->only('student_assignment');
        $this->middleware('role:7')->only('student_assignment');
*/

class HousingTest extends MyTestCase
{
    public function test_housing_no_session()
    {
        $response = $this->get('/housing');
        $response->assertStatus(302);
    }

    public function test_housing_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing');

        $response->assertStatus(200);
    }

    public function test_housing_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing');

        $response->assertStatus(200);
    }

    public function test_housing_with_id_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing/' . $student->id);

        $response->assertStatus(200);
    }

    public function test_housing_with_different_id_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing/' . ($student->id +1));

        $response->assertStatus(200);
    }

    public function test_housing_with_id_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing/' . $student->id);

        $response->assertStatus(200);
    }

    public function test_housing_update_no_session()
    {
        $response = $this->post('/housing');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_housing_update_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/housing', [
                'question' => ['1' => 'test'],
            ]);
        $response->assertStatus(302);
        $response->assertRedirect('/housing');
    }

    public function test_housing_update_admin_session_role_7()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"7"%')->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/housing', [
                'question' => ['1' => 'test'],
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/housing');
    }

    public function test_housing_update_admin_session_not_role_7()
    {
        $user = User::where('admin', 1)->where('access', 'not like', '%"7"%')->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/housing', [
                'question' => ['1' => 'test'],
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }

    public function test_housing_accept_terms_no_session()
    {
        $response = $this->post('/housing/accept_terms');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_housing_accept_terms_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/housing/accept_terms');

        $response->assertStatus(200);
    }

    public function test_housing_accept_terms_admin_session()
    {
        $user = User::where('admin', 1)->first();
        $student = $this->get_student();

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/housing/accept_terms');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_housing_admin_index_no_session()
    {
        $response = $this->get('/housing/home');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_housing_admin_index_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing/home');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_housing_admin_index_admin_session_role_2()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"2"%')->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->get('/housing/home');

        $response->assertStatus(200);
    }

    public function test_housing_admin_index_admin_session_role_7()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"7"%')->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->get('/housing/home');

        $response->assertStatus(200);
    }

    public function test_housing_admin_index_admin_session_not_role_2_7()
    {
        $user = User::where('admin', 1)
            ->where('access', 'not like', '%"2"%')
            ->where('access', 'not like', '%"7"%')
            ->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->get('/housing/home');

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }

    public function test_housing_requests_no_session()
    {
        $response = $this->get('/housing/requests');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_housing_requests_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->get('/housing/requests');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_housing_requests_admin_session_role_2()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"2"%')->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->get('/housing/requests');

        $response->assertStatus(200);
    }

    public function test_housing_requests_admin_session_role_7()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"7"%')->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->get('/housing/requests');

        $response->assertStatus(200);
    }

    public function test_housing_requests_admin_session_not_role_2_7()
    {
        $user = User::where('admin', 1)
            ->where('access', 'not like', '%"2"%')
            ->where('access', 'not like', '%"7"%')
            ->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->get('/housing/requests');

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }

    public function test_housing_assignment_no_session()
    {
        $response = $this->post('/housing_assignment');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_housing_assignment_student_session()
    {
        $user = User::where('admin', 0)->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => $student->semester,
                'student' => $student->id,
            ])->post('/housing_assignment');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_housing_assignment_admin_session_role_7()
    {
        $user = User::where('admin', 1)->where('access', 'like', '%"7"%')->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->post('/housing_assignment');

        $response->assertStatus(302);
        $response->assertRedirect('/housing');
    }

    public function test_housing_assignment_admin_session_not_role_7()
    {
        $user = User::where('admin', 1)
            ->where('access', 'not like', '%"7"%')
            ->first();
        $student = $this->get_student($user);

        $response = $this->actingAs($user)
            ->withSession([
                'semester' => 'Spring 2020',
            ])->post('/housing_assignment');

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }


}
