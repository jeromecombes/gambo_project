<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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

        $answers = Answer::where('project_id', $project->id)->get();
        $options = ProjectOption::where('project_id', $project->id)->withOptions()->orderBy('option_order', 'asc')->get();
        $questions = Question::whereIn('option_id', $options->pluck('id'))->orderBy('order', 'asc')->get();

        foreach ($questions as &$question) {
            $question->answer = $answers->where('question', $question->name)->first()->answer;
        }

        return view('client.index', compact('options', 'project', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientController $clientController)
    {
        $project = Project::find($request->id);

        if (!$project) {
            echo 'Accès refusé !';
            return;
        }

        $options = ProjectOption::where('project_id', $project->id)->withOptions()->orderBy('option_order', 'asc')->get();
        $questions = Question::whereIn('option_id', $options->pluck('id'))->orderBy('order', 'asc')->get();

        foreach($questions as $question) {
            $answer = Answer::updateOrCreate([
                    'project_id' => $project->id,
                    'question' => $question->name,
                ],
                [
                    'answer' => $request->{$question->name},
                ]
            );
            $answer->save();
        }

        return redirect()->route('client.index', ['token' => $project->token])->with('success', 'Projet modifié !');
    }

}
