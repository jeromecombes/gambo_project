<?php

namespace App\Http\Controllers;

use App\Helpers\CourseHelper;
use App\Models\Tutoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ScheduleController extends Controller
{
    public function __construct()
    {
        App::setLocale('fr_FR');
    }

    /**
     * Display a schedule
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $courses = array();

        foreach (CourseHelper::get()->all as $elem) {
            if ($elem->day) {
                $courses[] = $elem;
            }
        }

        // Get tutoring
        $tutoring = Tutoring::findMe();
        if ($tutoring) {
            if ($tutoring->day) {
                $courses[] = $tutoring;
            }
        }

        usort($courses, [$this, 'cmp_day']);

        // View
        return view('schedule.index', compact('courses'));
    }
}
