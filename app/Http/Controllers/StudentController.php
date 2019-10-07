<?php

namespace App\Http\Controllers;

use App\Student;
use App\Univ_reg3;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    /**
     * Display a listing of students for admins
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_index(Request $request)
    {
        // Semester
        $request->session()->put('semester', $_SESSION['vwpp']['semester']);
        $semester = session('semester');

        $students = Student::where('semesters', 'like', "%$semester%")
            ->select('students.id', 'students.lastname', 'students.firstname', 'students.gender', 'students.email', 'students.university', 'students.guest')
            ->get();

        // Add university registration information
        $univ_reg = Univ_reg3::where('semester', $semester)->get();

        foreach ($students as $key => $student) {
            $univ = null;
            foreach ($univ_reg as $elem) {
                if ($elem->student == $student->id) {
                    $students[$key]->setUnivregAttribute($elem->university);
                }
            }
        }

        // Count students
        $vassar = $students->where('university', 'Vassar')->where('guest', '!=', '1')->count();
        $wesleyan = $students->where('university', 'Wesleyan')->where('guest', '!=', '1')->count();
        $other = $students->where('guest', 1)->count();

        // Filter on home institution (Vassar or Wesleyan)
        $login_univ = $_SESSION['vwpp']['login_univ'];
        if ($login_univ != 'VWPP') {
            foreach ($students as $key => $value) {
                if ($value->university != $login_univ) {
                    $students->forget($key);
                }
            }
        }

        // View
        return view('admin.students', compact('students', 'vassar', 'wesleyan', 'other'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
