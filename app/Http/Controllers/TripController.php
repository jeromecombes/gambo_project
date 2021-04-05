<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Mail\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class TripController extends Controller
{
    public function __construct()
    {
        App::setLocale('fr_FR');
    }

    /**
     * Edit a trip form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $edit = true;

        // All existing students courses for making links
        $student = Student::find(session('student'));

        $trip = (object) array(
            'lastname' => $student->lastname,
            'firstname' => $student->firstname,
            'email' => $student->email,
            'cellphone' => $student->cellphone,
            'start' => null,
            'end' => null,
            'destination' => null,
            'transport' => null,
            'address' => null,
            'phone' => null,
            'parents_notification' => null,
            'university_notification' => null,
            'terms' => null,
        );

        // View
        return view('trip.edit', compact('edit', 'trip'));
    }

    /**
     * Register a trip form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $to = explode(',', env('MAIL_TRIP_FORM'));

        foreach ($to as $elem) {
            Mail::to(trim($elem))->send(new Trip($request));
        }

        return view('trip.sent');
    }
}
