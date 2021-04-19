<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\HostAvailable;
use App\Models\HousingAssignment;
use App\Models\Student;
use Illuminate\Http\Request;

class HostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('semester');
        $this->middleware('role:2|7');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        // Selected semester
        $semester = substr(session('semester'), -4);
        $semester .= substr(session('semester'),0,6)=="Spring"?1:2;

        // Available hosts for the selected semester
        $available = HostAvailable::where('start', '<=', $semester)
            ->where(function ($query) use ($semester) {
                $query->where('end', '>=', $semester)
                ->orWhere('end', 0);
            })
            ->get(array('id'))
            ->toArray();

        // Hosts information
        $hosts = Host::whereIn('id', $available)->get();

        // Student assignment
        $assignment = HousingAssignment::whereIn('logement', $available)
            ->where('housing_affect.semester', session('semester'))
            ->select('logement')
            ->withStudents()
            ->get();

        $hosts->each(function ($host) use ($assignment) {
            $student = $assignment->where('logement', $host->id)->first();
            if ($student) {
                $host->studentname = $student->studentname;
            }
        });

        // Edit access
        $edit_access = in_array(7, $user->access);

        return view('hosts.index', compact('hosts', 'edit_access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function show(Host $host)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function edit(Host $host)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Host $host)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function destroy(Host $host)
    {
        //
    }
}
