<?php

namespace App\Http\Controllers;

use App\Models\CourseChoice;
use App\Models\Grade;
use App\Models\Host;
use App\Models\Housing;
use App\Models\HousingClosed;
use App\Models\HousingTerm;
use App\Models\HousingAssignment;
use App\Models\Internship;
use App\Models\RHCourseAssignment;
use App\Models\RHCourseLock;
use App\Models\RHCoursePublish;
use App\Models\Student;
use App\Models\Tutoring;
use App\Models\UnivCourse;
use App\Models\UnivReg;
use App\Models\UnivReg2;
use App\Models\UnivReg3;
use App\Models\UnivRegLock;
use App\Models\UnivRegShow;
use App\Models\User;
use App\Helpers\CountryHelper;
use App\Helpers\StateHelper;
use App\Http\Controllers\DocumentController;
use App\Mail\Cellphone_changed;
use App\Mail\Sendmail;
use App\Mail\Student_create;
use App\Mail\Student_delete;
use App\Mail\Student_welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('semester');

        // Student form
        $this->middleware('student.list')->only('student_form');
        $this->middleware('role:1|4|5')->only('student_form');

        // Admin
        $this->middleware('admin')->only(['admin_index', 'create', 'destroy', 'store']);
        $this->middleware('role:4')->only(['create', 'store']);
        $this->middleware('role:5')->only('destroy');
    }

    /**
     * Display a listing of students for admins
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_index(Request $request)
    {
        $user = auth()->user();

        $request->session()->put('student', null);

        // Semester
        $semester = session('semester');

        $students = Student::where('semesters', 'like', "%$semester%")
            ->get();

        // Add university registration information
        $univ_reg = UnivReg3::where('semester', $semester)->get();

        foreach ($students as $key => $student) {
            $univ = $univ_reg->where('student', $student->id)->first();
            $students[$key]->setUnivregAttribute($univ->university ?? null);
        }

        // Count students
        $vassar = $students->where('university', 'Vassar')->where('guest', '!=', '1')->count();
        $wesleyan = $students->where('university', 'Wesleyan')->where('guest', '!=', '1')->count();
        $other = $students->where('guest', 1)->count();

        // Filter on home institution (Vassar or Wesleyan)
        if ($user->university != 'VWPP') {
            foreach ($students as $key => $value) {
                if ($value->university != $user->university) {
                    $students->forget($key);
                }
            }
        }

        // Dropdown menu under the student list
        $options = array();
        $options[] = (object) array('value' => '', 'text' => null);
        $options[] = (object) array('value' => 'Excel', 'text' => 'Export General Info to Excel');
        if (in_array(17, $user->access)) {
            $options[] = (object) array('value' => 'Univ_reg', 'text' => 'Export Univ. Reg. to Excel');
        }
        if (in_array(23, $user->access)) {
            $options[] = (object) array('value' => 'internship', 'text' => 'Export Internship to Excel');
            $options[] = (object) array('value' => 'tutoring', 'text' => 'Export Tutoring to Excel');
        }
        $options[] = (object) array('value' => 'Email', 'text' => 'Send email (with Email Program)');
        $options[] = (object) array('value' => 'Email2', 'text' => 'Send email (with Web Browser)');
        if (in_array(4, $user->access)) {
            $options[] = (object) array('value' => 'CreatePassword', 'text' => 'Send emails with passwords');
        }
        if (in_array(5, $user->access)) {
        $options[] = (object) array('value' => 'Delete', 'text' => 'Delete');
        }
        if (in_array(7, $user->access)) {
            $options[] = (object) array('value' => 'closeHousing', 'text' => 'Close housing');
            $options[] = (object) array('value' => 'openHousing', 'text' => 'Open housing');
        }
        if (in_array(16, $user->access)) {
            $options[] = (object) array('value' => 'lockVWPP', 'text' => 'Lock VWPP Courses reg.');
            $options[] = (object) array('value' => 'unlockVWPP', 'text' => 'Unlock VWPP Courses reg.');
            $options[] = (object) array('value' => 'publishVWPP', 'text' => 'Publish VWPP Courses Final reg.');
            $options[] = (object) array('value' => 'hideVWPP', 'text' => 'Hide VWPP Courses Finale reg.');
        }
        if (in_array(17, $user->access)) {
            $options[] = (object) array('value' => 'publishUnivReg', 'text' => 'Publish Univ. reg.');
            $options[] = (object) array('value' => 'hideUnivReg', 'text' => 'Hide Univ. reg.');
        }

        // View
        return view('admin.students', compact('students', 'options', 'vassar', 'wesleyan', 'other'));
    }

    /**
     * Display the form for sending emails to students
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function email(Request $request)
    {
        $student_ids = join(',', $request->students);

        $students = array();
        foreach (Student::findMine()->whereIn('id', $request->students) as $student) {
            $students[] = $student->display_name;
        }

        sort($students);
        $students = join('; ', $students);

        // View
        return view('students.email', compact('student_ids', 'students'));

    }

    /**
     * Create or change students' password
     * Send the welcome message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request)
    {
        if (!empty($request->students)) {
            $students = Student::whereIn('id', $request->students)->get();

            foreach ($students as $student) {
                $password = Str::random(8);
                $user = User::where('email', $student->email)->first();
                $user->password = $password;
                $user->save();

                try {
                    Mail::to($student->email)->send(new Student_welcome($student, $password));
                } catch(\Exception $e) {
                    report($e);
                }
            }
        }

        return redirect("/students")->with('success', 'Les mots de passe ont été créés ou modifiés. Le message de bienvenue a été envoyé.');
    }

    /**
     * Send email to students
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendmail(Request $request)
    {

        $ids = explode(',', $request->students);

        $students = Student::findMine()->whereIn('id', $ids);

        $data = (object) array(
            'subject' => $request->subject,
            'message' => $request->message,
        );

        foreach($students as $student) {
            try {
                Mail::to($student->email)->send(new Sendmail($data));
            } catch(\Exception $e) {
                report($e);
            }
        }

        return redirect("/students")->with('success', 'Le mail a été envoyé avec succès');
    }

    /**
     * Export general information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $filename = 'students_' .session('semester') . '.xlsx';

        return Excel::download(new StudentExport, $filename);
    }

    /**
     * Display general information of a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student_form(Request $request)
    {
        $user = auth()->user();

        $edit = $request->edit;

        $id = session('student');
        $student = Student::find($id);

        $document = new DocumentController();
        $photo = $document->get_photo($id);

        $housing = HousingAssignment::where('student', $id)->where('semester', session('semester'))->first();
        $host = $housing ? Host::find($housing->logement) : null;

        $univ_reg = UnivReg3::findMe();
        $french_univ = $univ_reg ? $univ_reg->university : null;

        $months = array(
            (object) array( 'id' => '01', 'name' => 'January'),
            (object) array( 'id' => '02', 'name' => 'Febuary'),
            (object) array( 'id' => '03', 'name' => 'March'),
            (object) array( 'id' => '04', 'name' => 'April'),
            (object) array( 'id' => '05', 'name' => 'May'),
            (object) array( 'id' => '06', 'name' => 'June'),
            (object) array( 'id' => '07', 'name' => 'July'),
            (object) array( 'id' => '08', 'name' => 'August'),
            (object) array( 'id' => '09', 'name' => 'September'),
            (object) array( 'id' => '10', 'name' => 'October'),
            (object) array( 'id' => '11', 'name' => 'November'),
            (object) array( 'id' => '12', 'name' => 'December'),
        );

        $years = array(date("Y") - 15, date("Y") - 30);

        $states = StateHelper::get();
        $countries = CountryHelper::get();

        // View
        return view('students.student_form', compact('student', 'photo', 'host', 'french_univ', 'countries', 'states', 'months', 'years', 'edit'));
    }

    /**
     * Update general information of a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student_form_update(Request $request)
    {

        $student = Student::find(session('student'));

        // Get initial cellphone
        $cellphone = $student->cellphone;

        // Token
        $mail = trim(strtolower($request->email));
        $mail = htmlentities($mail, ENT_QUOTES | ENT_IGNORE, 'UTF-8');
        $token = md5($mail);

        // Semesters
        $student->semesters = $request->semesters;

        // Date of birth
        $dob = null;
        if ($request->yob and $request->mob and $request->dob) {
            $dob = $request->yob . '-' . $request->mob . '-' . $request->dob;
        }

        $student->lastname = $request->lastname;
        $student->firstname = $request->firstname;
        $student->gender = $request->gender;
        $student->citizenship1 = $request->citizenship1;
        $student->citizenship2 = $request->citizenship2;
        $student->dob = $dob;
        $student->placeOB = $request->placeOB;
        $student->countryOB = $request->countryOB;
        $student->email = $request->email;
        $student->cellphone = $request->cellphone;
        $student->contactlast = $request->contactlast;
        $student->contactfirst = $request->contactfirst;
        $student->street = $request->street;
        $student->city = $request->city;
        $student->zip = $request->zip;
        $student->state = $request->state;
        $student->country = $request->country;
        $student->contactphone = $request->contactphone;
        $student->contactmobile = $request->contactmobile;
        $student->contactemail = $request->contactemail;
        $student->resultatTCF = $request->resultatTCF;
        $student->semesters = $request->semesters;
        $student->token = $token;

        if ($request->frenchNumber) {
            $student->frenchNumber = $request->frenchNumber;
        }

        $student->save();

        if ($cellphone != $request->cellphone) {
            $users = User::where('admin', 1)->where('alerts', 1)->get();

            if ($users->isNotEmpty()) {

                $data = (object) array(
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'cellphone' => $request->cellphone,
                );

                foreach($users as $user) {
                    try {
                        Mail::to($user->email)->send(new Cellphone_changed($data));
                    } catch(\Exception $e) {
                        report($e);
                    }
                }
            }
        }

        return redirect("/student")->with('success', 'Mise à jour réussie');
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
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $university = $user->university;
        $email_data = array();

        foreach ($request->students as $elem) {
            if (empty($elem[2])) {
                continue;
            }

            $password = Str::random(8);

            // Save student's information
            $student = new Student();
            $student->lastname = $elem[0];
            $student->firstname = $elem[1];
            $student->email = $elem[2];
            $student->token = $elem[2];
            $student->university = $university;
            $student->guest = $elem[3] ?? null;
            $student->semester = session('semester');
            $student->semesters = array(session('semester'));
            $student->save();

            // Create an account
            $user = new User();
            $user->admin = 0;
            $user->email = $elem[2];
            $user->password = $password;
            $user->save();

            // Email data
            $email_data[] = (object) array(
                'lastname' => $elem[0],
                'firstname' => $elem[1],
                'email' => $elem[2],
                'visiting' => !empty($elem[3]) ? 'Visiting' : null,
            );
        }

        // Send an email to administrators
        $users = User::where('alerts', 1)->get();

        if (count($users) and !empty($email_data)) {
            foreach($users as $user) {
                try {
                    Mail::to($user->email)->send(new Student_create($email_data));
                } catch(\Exception $e) {
                    report($e);
                }
            }
        }

        return redirect()->route('student.index')->withSuccess('Students were added successfuly !');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Get selected students
        $students = Student::findOrFail($request->students);

        // Send an email to administrators
        $users = User::where('alerts', 1)->get();

        if (count($users) and count($students)) {
            foreach($users as $user) {
                try {
                    Mail::to($user->email)->send(new Student_delete($students));
                } catch(\Exception $e) {
                    report($e);
                }
            }
        }

        // Delete students related information
        CourseChoice::whereIn('student', $request->students)->delete();
        Grade::whereIn('student', $request->students)->delete();
        Housing::whereIn('student', $request->students)->delete();
        HousingClosed::whereIn('student', $request->students)->delete();
        HousingAssignment::whereIn('student', $request->students)->delete();
        HousingTerm::whereIn('student', $request->students)->delete();
        Internship::whereIn('student', $request->students)->delete();
        RHCourseAssignment::whereIn('student', $request->students)->delete();
        RHCourseLock::whereIn('student', $request->students)->delete();
        RHCoursePublish::whereIn('student', $request->students)->delete();
        Tutoring::whereIn('student', $request->students)->delete();
        UnivCourse::whereIn('student', $request->students)->delete();
        UnivReg::whereIn('student', $request->students)->delete();
        UnivReg2::whereIn('student', $request->students)->delete();
        UnivReg3::whereIn('student', $request->students)->delete();
        UnivRegLock::whereIn('student', $request->students)->delete();
        UnivRegShow::whereIn('student', $request->students)->delete();

        // TODO : delete documents : créer DocumentController::delete_students_docs(students ID)

        // Delete students
        foreach ($students as $student) {

            User::where('email', $student->email)->delete();

            $student->delete();

            // TODO : delete password_resets where email : Model à créer
        }

        return redirect('/students')->with('success', 'Selected students have been successfuly deleted');
    }
}
