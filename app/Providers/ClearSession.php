<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session as Session;

class ClearSession
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        // Clear Old Session ($_SESSION['VWPP'])
        // TODO : remove this class when Laravel migration will be completed
        session_start();
        session_destroy();
    }
}
