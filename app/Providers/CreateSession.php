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
        session_start();

        // Admin and Students
        $_SESSION['vwpp']['email'] = $event->user->email;
        $_SESSION['vwpp']['language'] = $event->user->language;
        $_SESSION['vwpp']['login'] = $event->user->email;

        // Admin only
        if ($event->user->access) {
            $_SESSION['vwpp']['access'] = $event->user->access;
            $_SESSION['vwpp']['login_name'] = $event->user->displayName;
            $_SESSION['vwpp']['login_univ'] = $event->user->university;

            Session::put('login_name', $event->user->displayName);

        // Students only
        } else {

            foreach (Student::all() as $student) {
                if ($student->email == $event->user->email) {
                    Session::put('login_name', $student->firstname . ' ' . $student->lastname);
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
