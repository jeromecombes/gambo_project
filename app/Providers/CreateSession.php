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

        // For students only
        if (!$event->user->admin) {
            $student = Student::where('user_id', $event->user->id)->first();

            Session::put('semesters', $student->semesters);
            Session::put('student', $student->id);

            if (count($student->semesters) == 1) {
                Session::put('semester', $student->semesters[0]);
            }
        }
    }
}
