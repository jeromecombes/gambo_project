<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_admin_lastname()
    {
        $user = User::where('admin', 1)->first();
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9 éô]{1,30}$/', $user->lastname);
    }

    public function test_get_admin_firstname()
    {
        $user = User::where('admin', 1)->first();
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9 éô]{1,30}$/', $user->firstname);
    }

    public function test_get_admin_display_name()
    {
        $user = User::where('admin', 1)->first();
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9 éô]{1,60}$/', $user->display_name);
    }

    public function test_get_student_lastname()
    {
        $user = User::where('admin', 0)->first();
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9 éô]{1,30}$/', $user->lastname);
    }

    public function test_get_student_firstname()
    {
        $user = User::where('admin', 0)->first();
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9 éô0-9]{1,30}$/', $user->firstname);
    }

    public function test_get_student_display_name()
    {
        $user = User::where('admin', 0)->first();
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9 éô]{1,60}$/', $user->display_name);
    }
}
