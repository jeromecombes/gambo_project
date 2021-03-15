<?php

namespace App\Http\Controllers;

use App\Host;
use App\Housing;
use App\HousingAssignment;
use App\HousingTerm;
use App\Student;
use Illuminate\Http\Request;

class HousingController extends Controller
{
    /**
     * Display Housing index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.housing');
    }

    /**
     * Display students requests
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function requests(Request $request)
    {

        // Semester
        $semester = str_replace(" ", "_", session('semester'));

        // Students information, students filter
        $university = session('login_univ');
        if ($university == 'VWPP') {
            // All students if loged in admin is from VWPP
            $students = Student::where('semestre', $semester)->get();
        } else {
            // Filter students if loged in admin is from Vassar or Wesleyan
            $students = Student::where(array('semestre' => $semester, 'university' => $university))->get();
        }

        // Questions
        $questions = $this->getQuestions();
        $questions_ids = array_keys($questions);

        // Answers
        $housing = Housing::where('semestre', $semester)->get();

        $answers = array();
        foreach ($housing as $elem) {
            $answers[$elem['student']][$elem['question']] = $elem['response'];

            // Add blank indexex, avoid undefined index errors
            foreach ($questions_ids as $id) {
                if (!array_key_exists($id, $answers[$elem['student']])) {
                    $answers[$elem['student']][$id] = null;
                }
            }
        }

        foreach ($answers as $key => $value) {
            $answers[$key]['student'] = $key;

            if ($students->where('id', $key)->first()) {
                $answers[$key]['lastname'] = $students->where('id', $key)->first()->lastname;
                $answers[$key]['firstname'] = $students->where('id', $key)->first()->firstname;
            } else {
                // Apply students filter and remove information from deleted students
                unset($answers[$key]);
            }

        }

        // Edit access
        $edit_access = in_array(7, session('access'));

        return view('admin.housing_requests', compact('questions', 'questions_ids', 'answers', 'edit_access'));
    }

    /**
     * Display the housing student form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student_form(Request $request)
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
        return view('housing.student_form', compact('edit', 'student', 'hosts', 'selected_host', 'answer', 'terms_accepted'));
    }

    /**
     * Update housing student information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student_form_update(Request $request)
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
    public function student_assignment(Request $request)
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
     * @param  \App\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function show(Housing $housing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function edit(Housing $housing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Housing $housing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Housing $housing)
    {
        //
    }

    private function getQuestions()
    {
        $semester = session('semester');
        $year = substr($semester, -4);

        if ($year < 2020) {
            $questions=array();
            $questions[1]="Group flight";
            $questions[3]="Housing Arranged by VWPP";
            $questions[4]="With whom and where you will be living";
            $questions[5]="1. Have you ever travel or lived in France";
            $questions[6]="2. Home stay experience";
            $questions[7]="3. Your own family like";
            $questions[8]="4. Independent living situation before";
            $questions[9]="5. With roommates";
            $questions[10]="6. Did you cook";
            $questions[11]="7. influence";
            $questions[12]="8. Reasons for coming to Paris";
            $questions[13]="9. Academic interests";
            $questions[14]="10. Extra-curricular";
            $questions[15]="11. Smoke";
            $questions[16]="11. Can you live with smookers";
            $questions[17]="1. Vegetarian";
            $questions[18]="2a. eat fish";
            $questions[19]="2b. eat chicken";
            $questions[20]="2c. eat eggs";
            $questions[21]="2d. dairy products";
            $questions[22]="2e. pork";
            $questions[23]="3. eat red meat";
            $questions[24]="4a. Dietary allergies";
            $questions[25]="4b customs";
            $questions[26]="5 adhere to these dietary";
            $questions[27]="6 allergies";
            $questions[28]="1. principal concern";
            $questions[30]="2. Appartement";
            $questions[31]="2. Collocation";
            $questions[32]="Other information";
        } else {
            $questions=array();
            $questions[1]="Group flight";
            $questions[3]="Housing Arranged by VWPP";
            $questions[4]="With whom and where you will be living";
            $questions[5]="1. Have you ever travel or lived in France";
            $questions[6]="2. Home stay experience";
            $questions[7]="3. Your own family like";
            $questions[12]="4. Reasons for coming to Paris";
            $questions[13]="5. Academic interests";
            $questions[14]="6. Extra-curricular";
            $questions[15]="7. Smoke";
            $questions[16]="8. Can you live with smookers";
            $questions[17]="1. Vegetarian";
            $questions[29]="2. Vegan";
            $questions[18]="3a. eat fish";
            $questions[19]="3b. eat chicken";
            $questions[20]="3c. eat eggs";
            $questions[21]="3d. dairy products";
            $questions[22]="3e. pork";
            $questions[23]="4. eat red meat";
            $questions[24]="5a. Dietary allergies";
            $questions[25]="5b customs";
            $questions[26]="6 adhere to these dietary";
            $questions[27]="7 allergies";
            $questions[28]="1. principal concern";
        }

        return $questions;
    }

}
