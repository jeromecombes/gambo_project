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
        $_SESSION['vwpp']['last_activity'] = time();
        $_SESSION['vwpp']['login'] = $event->user->email;

        // Admin only
        if ($event->user->access) {
            $_SESSION['vwpp']['access'] = unserialize($event->user->access);
            $_SESSION['vwpp']['category'] = 'admin';
            $_SESSION['vwpp']['login_id'] = $event->user->id;
            $_SESSION['vwpp']['login_name'] = $event->user->firstname . ' ' . $event->user->lastname;
            $_SESSION['vwpp']['login_univ'] = $event->user->university;

            Session::put('access', unserialize($event->user->access));
            Session::put('admin', true);
            Session::put('login_name', $event->user->firstname . ' ' . $event->user->lastname);

        // Students only
        } else {

            foreach (Student::all() as $student) {
                if ($student->email == $event->user->email) {
                    $_SESSION['vwpp']['access'] = array();
                    $_SESSION['vwpp']['category'] = 'student';
                    $_SESSION['vwpp']['login_id'] = $student->id;
                    $_SESSION['vwpp']['login_name'] = $student->firstname . ' ' . $student->lastname;
                    $_SESSION['vwpp']['login_univ'] = $student->university;
                    $_SESSION['vwpp']['semesters'] = $student->semesters;
                    $_SESSION['vwpp']['student'] = $student->id;

                    Session::put('access', array());
                    Session::put('login_name', $student->firstname . ' ' . $student->lastname);
                    Session::put('semesters', $student->semesters);
                    Session::put('student', $student->id);

                    if (count($student->semesters) == 1) {
                        $_SESSION['vwpp']['semester'] = $student->semesters[0];
                        $_SESSION['vwpp']['semestre'] = $student->semesters[0];
                        Session::put('semester', $student->semesters[0]);
                    }

                    break;
                }
            }
        }

    }
}
