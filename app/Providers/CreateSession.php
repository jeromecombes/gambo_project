<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session as Session;

class CreateSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Admin only
        if ($event->user->admin) {
            Session::put('login_name', $event->user->display_name);

        // Students only
        } else {

            foreach (Student::all() as $student) {
                if ($student->email == $event->user->email) {
                    Session::put('login_name', $student->display_name);
                    Session::put('semesters', $student->semesters);
                    Session::put('student', $student->id);

                    if (count($student->semesters) == 1) {
                        Session::put('semester', $student->semesters[0]);
                    }

                    break;
                }
            }
        }

    }
}
