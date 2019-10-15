<?php

namespace App\Http\Controllers;

use App\Host;
use App\HostAvailable;
use App\HousingAssignment;
use App\Student;
use Illuminate\Http\Request;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            ->where('semester', session('semester'))
            ->select('logement')
            ->withStudents()
            ->get();

        foreach ($hosts as $key => $value) {
            foreach ($assignment as $assign) {
                if ($value->id == $assign->logement) {
                    $hosts[$key]->studentname = $assign->studentname;
                    continue;
                }
            }
        }

        // Edit access
        $edit_access = in_array(7, session('access'));

        return view('admin.hosts', compact('hosts', 'edit_access'));
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
