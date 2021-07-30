<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MyTestCase extends TestCase
{
    protected function get_student($user = null)
    {
        if (!$user) {
            $user = User::where('admin', 0)->first();
        }

        return Student::where('user_id', $user->id)->first();
    }
}
