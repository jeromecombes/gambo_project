<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Project;
use App\Models\ProjectOption;
use App\Models\Question;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display client index
     */
    public function index(Request $request)
    {
        $project = Project::where('token', $request->token)->where('status', 0)->first();

        if (!$project) {
            echo 'Accès refusé !';
            return;
        }

        $options = ProjectOption::where('project_id', $project->id)->withOptions()->orderBy('option_order', 'asc')->get();
        $questions = Question::whereIn('option_id', $options->pluck('id'))->orderBy('order', 'asc')->get();

        return view('client.index', compact('options', 'project', 'questions'));
    }
}
