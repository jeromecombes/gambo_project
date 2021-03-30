<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class InternshipController extends Controller
{
    public function __construct()
    {
        App::setLocale('fr_FR');
    }

    /**
     * Edit an internship
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $edit = true;

        // All existing students courses for making links
        $internship = Internship::findOrCreateMe();

        // Admin with modification access
        $admin2 = in_array(16, session('access'));

        $params = compact(
            'admin2',
            'edit',
            'internship',
        );

        // View
        return view('courses.internship_form', $params);
    }

    /**
     * Add or update a tutoring
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if ($request->id) {
            $internship = Internship::find($request->id);
        } else {
            $internship = new Internship();
            $internship->student = session('student');
            $internship->semester = session('semester');
        }

        $internship->internship = $request->internship;
        $internship->name = $request->name;
        $internship->notes = $request->notes;
        $internship->save();

        return redirect()->route('courses.index')->with('success', 'Mise à jour réussie');
    }

}
