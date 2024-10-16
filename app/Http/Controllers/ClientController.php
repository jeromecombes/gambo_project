<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

        return view('client.index', compact('project'));
    }
}
