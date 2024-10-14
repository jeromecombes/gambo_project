<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectSupport;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $projects = Project::where('manager', $user->id)->get();

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ProjectController $projectController)
    {
        $products = Product::all();

        if ($request->id) {
            $project = Project::find($request->id);

            if ($project->manager != $request->user()->id) {
              echo "accès refusé";
              return;
            }
        } else {
            $project = new Project();
        }

        $supports = [];
        $supportDB = ProjectSupport::where('project_id', $request->id)->get();
        for ($i = 0; $i < 5; $i++) {
            $supports[$i]['lastname'] = $supportDB->where('position', $i)->first()->lastname ?? null;
            $supports[$i]['firstname'] = $supportDB->where('position', $i)->first()->firstname ?? null;
            $supports[$i]['email'] = $supportDB->where('position', $i)->first()->email ?? null;
        }

        return view('project.edit', compact('project', 'products', 'supports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectController $projectController)
    {
        if ($request->id) {
            $project = Project::find($request->id);

            if ($project->manager != $request->user()->id) {
              echo "accès refusé";
              return;
            }
        } else {
            $project = new project();
        }

        $project->order = $request->order;
        $project->customer = $request->customer;
        $project->email = $request->email;
        $project->product_id = $request->product;
        $project->manager = $request->user()->id;
        $project->save();

        for ($i = 0; $i < 5; $i++) {
            $support = ProjectSupport::firstOrNew(['project_id' => $project->id, 'position' => $i]);
            $support->lastname = $request->support_lastname[$i];
            $support->firstname = $request->support_firstname[$i];
            $support->email = $request->support_email[$i];
            $support->save();
        }

        return redirect()->route('project.index')->with('success', 'Projet modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProjectController $projectController)
    {
        $project = Project::find($request->id);

        if ($project->manager != $request->user()->id) {
            return redirect()->route('project.index')->with('error', 'Accès refusé !');
        }

        ProjectSupport::where('project_id', $project->id)->delete();

        $project->delete();
        return redirect()->route('project.index')->with('success', 'Project supprimé !');
    }
}
