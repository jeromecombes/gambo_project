<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Exports\TutoringExport;
use Maatwebsite\Excel\Facades\Excel;

class TutoringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('semester');
        $this->middleware('role:16');
        $this->middleware('student.list');

        $this->middleware('admin')->only('export');

        App::setLocale('fr_FR');
    }

    /**
     * Edit a tutoring
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $edit = true;

        // All existing students courses for making links
        $tutoring = Tutoring::findOrCreateMe();

        // Admin with modification access
        $user = auth()->user();
        $admin2 = in_array(16, $user->access);

        $params = compact(
            'admin2',
            'edit',
            'tutoring',
        );

        // View
        return view('tutoring.index', $params);
    }

    /**
     * Export tutoring
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $filename = 'tutoring_' .session('semester') . '.xlsx';

        return Excel::download(new TutoringExport, $filename);
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
            $tutoring = Tutoring::find($request->id);
        } else {
            $tutoring = new Tutoring();
            $tutoring->student = session('student');
            $tutoring->semester = session('semester');
        }

        $tutoring->tutor = $request->tutor;
        $tutoring->day = $request->day;
        $tutoring->start = $request->start;
        $tutoring->end = $request->end;
        $tutoring->save();

        return redirect()->route('courses.index')->with('success', 'Mise à jour réussie');
    }
}
