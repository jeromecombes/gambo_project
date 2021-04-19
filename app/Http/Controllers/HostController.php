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
        $this->middleware('role:7')->only(['destroy', 'update']);
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
            ->get(array('logement_id'))
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
        $edit = true;
        $host = new Host();
        $student = (object) ['lastname' => null, 'firstname' => null];

        return view('hosts.edit', compact('edit', 'host', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $edit = $request->edit;

        $host = Host::find($id);

        $assignment = HousingAssignment::where('logement', $id)
            ->where('semester', session('semester'))
            ->first();

        $student = $assignment->std ?? (object) ['lastname' => null, 'firstname' => null];

        return view('hosts.edit', compact('edit', 'host', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $new = !$request->id;

        $host = Host::findOrNew($request->id);
        $host->lastname = $request->lastname;
        $host->firstname = $request->firstname;
        $host->email = $request->email;
        $host->cellphone = $request->cellphone;
        $host->lastname2 = $request->lastname2;
        $host->firstname2 = $request->firstname2;
        $host->email2 = $request->email2;
        $host->cellphone2 = $request->cellphone2;
        $host->address = $request->address;
        $host->zipcode = $request->zipcode;
        $host->city = $request->city;
        $host->phonenumber = $request->phonenumber;
        $host->save();

        if ($new) {
            $available = new HostAvailable();
            $available->host = $host->id;
            $available->start = session('semester');
            $available->save();
        }

        $message = $new ? "New host successfully added !" : "The host has been changed !";

        return redirect()->route('hosts.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $available = HostAvailable::where('logement_id', $request->id)->first();
        $available->end = session('semester');
        $available->save();

        return redirect()->route('hosts.index')->withSuccess('Host was deleted successfully');
    }
}
