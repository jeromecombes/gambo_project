<?php

namespace App\Http\Controllers;

use App\Host;
use App\HostAvailable;
use App\Housing;
use App\HousingAssignment;
use App\HousingTerm;
use App\Student;
use App\Univ_reg3;
use App\User;
use App\Http\Controllers\DocumentController;
use App\Mail\Cellphone_changed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\Support\Facades\Mail;

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
        LaravelSession::forget('student');
        // Clear old session
        $_SESSION['vwpp']['student'] = null;

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

        // Dropdown menu under the student list
        $options = array();
        $options[] = (object) array('value' => '', 'text' => '&nbsp;');
        $options[] = (object) array('value' => 'Excel', 'text' => 'Export General Info to Excel');
        if (in_array(17,$_SESSION['vwpp']['access'])) {
            $options[] = (object) array('value' => 'Univ_reg', 'text' => 'Export Univ. Reg. to Excel');
        }
        if (in_array(23,$_SESSION['vwpp']['access'])) {
            $options[] = (object) array('value' => 'intership', 'text' => 'Export Internship to Excel');
            $options[] = (object) array('value' => 'tutorial', 'text' => 'Export Tutorial to Excel');
        }
        $options[] = (object) array('value' => 'Email', 'text' => 'Send email (with Email Program)');
        $options[] = (object) array('value' => 'Email2', 'text' => 'Send email (with Web Browser)');
        if (in_array(4,$_SESSION['vwpp']['access'])) {
            $options[] = (object) array('value' => 'CreatePassword', 'text' => 'Send emails with passwords');
        }
        if (in_array(5,$_SESSION['vwpp']['access'])) {
        $options[] = (object) array('value' => 'Delete', 'text' => 'Delete');
        }
        if (in_array(7,$_SESSION['vwpp']['access'])) {
            $options[] = (object) array('value' => 'closeHousing', 'text' => 'Close housing');
            $options[] = (object) array('value' => 'openHousing', 'text' => 'Open housing');
        }
        if (in_array(16,$_SESSION['vwpp']['access'])) {
            $options[] = (object) array('value' => 'lockVWPP', 'text' => 'Lock VWPP Courses reg.');
            $options[] = (object) array('value' => 'unlockVWPP', 'text' => 'Unlock VWPP Courses reg.');
            $options[] = (object) array('value' => 'publishVWPP', 'text' => 'Publish VWPP Courses Final reg.');
            $options[] = (object) array('value' => 'hideVWPP', 'text' => 'Hide VWPP Courses Finale reg.');
        }
        if (in_array(17,$_SESSION['vwpp']['access'])) {
            $options[] = (object) array('value' => 'publishUnivReg', 'text' => 'Publish Univ. reg.');
            $options[] = (object) array('value' => 'hideUnivReg', 'text' => 'Hide Univ. reg.');
        }

        // View
        return view('admin.students', compact('students', 'options', 'vassar', 'wesleyan', 'other'));
    }

    /**
     * Display general information of a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function general(Request $request)
    {
        include_once( __DIR__ . '/../../../public/inc/states.inc');

        $edit = $request->edit;

        $id = session('student');
        if (session('admin') and $request->id) {
            $id = $request->id;
        }

        $student = Student::find($id);

        $document = new DocumentController();
        $photo = $document->get_photo($id);

        $housing = HousingAssignment::where('student', $id)->where('semester', session('semester'))->first();
        $host = $housing ? Host::find($housing->logement) : null;

        $univ_reg = Univ_reg3::where('student', $id)->where('semester', session('semester'))->first();
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

        // View
        return view('students.general', compact('student', 'photo', 'host', 'french_univ', 'countries', 'states', 'months', 'years', 'edit'));
    }

    /**
     * Update general information of a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function general_update(Request $request)
    {

        $id = $request->id;
        $student = Student::find($id);

        // Get initial cellphone
        $cellphone = $student->cellphone;

        // Token
        $mail = trim(strtolower($request->email));
        $mail = htmlentities($mail, ENT_QUOTES | ENT_IGNORE, 'UTF-8');
        $token = md5($mail);

        // Semesters
        $student->semesters = $request->semesters;

        // Date of birth
        if ($request->yob and $request->mob and $request->dob) {
            $dob = new \DateTime($request->yob . '-' . $request->mob . '-' . $request->dob);
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
                    Mail::to($user->email)->send(new Cellphone_changed($data));
                }
            }
        }

        return redirect("/student")->with('success', 'Mise à jour réussie');
    }

    /**
     * Display housing information of a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function housing(Request $request)
    {

        $edit = $request->edit;

        // Get student info
        $id = session('student');
        if (session('admin') and $request->id) {
            $id = $request->id;
        }

        $student = Student::find($id);

        // Get available hosts
        $h = new Host();
        $hosts = $h->getHosts();

        // Get the selected host
        $selected_host = null;
        if (count($hosts) > 0) {
            $host = HousingAssignment::where('student', $student->id)->first();
            if ($host) {
                $selected_host = $hosts->find($host->logement);
            }
        }

        // Get housing's answers
        $semester = str_replace(' ', '_', session('semester'));
        $housing = Housing::where('student', $student->id)
            ->where('semestre', $semester)->get();

        $answer = array();
        for ($i = 1; $i <=32; $i++) {
            $h = $housing->where('question', $i)->first();
            $answer[$i] = $h ? $h->response : null;
        }

        // Check if terms are accepted
        $terms = HousingTerm::where('student', $id)
            ->where('semester', session('semester'))
            ->first();
        $terms_accepted = !empty($terms) ? true : false;

        // View
        return view('students.housing', compact('edit', 'student', 'hosts', 'selected_host', 'answer', 'terms_accepted'));
    }

    /**
     * Update housing
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function housing_update(Request $request)
    {

        $student = $request->student;
        $semester = str_replace(' ', '_', session('semester'));
        
        $housing = Housing::where('student', $student)
            ->where('semestre', $semester)->delete();

        foreach ($request->question as $question => $answer) {
            $housing = new Housing();
            $housing->student = $student;
            $housing->semester = $semester;
            $housing->question = $question;
            $housing->response = $answer;
            $housing->save();
        }

        return redirect("/housing")->with('success', 'Mise à jour réussie');
    }

    /**
     * Update housing assignment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function housing_assignment(Request $request)
    {

        $assignment = HousingAssignment::updateOrCreate(
            array(
                'student' => $request->student,
                'semester' => session('semester'),
            ),
            array(
                'logement' => $request->host,
            )
        );

        return redirect("/housing")->with('success', 'Mise à jour réussie');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $students = Student::findOrFail($request->students);
        foreach ($students as $student) {
            $student->delete();
        }

        return redirect('/admin/students')->with('success', 'Selected students have been successfuly deleted');
    }
}
