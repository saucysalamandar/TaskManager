<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Milestone;
use App\Project;
use App\Http\Requests\MilestoneFormRequest;

class MilestoneController extends Controller
{
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
    public function store(MilestoneFormRequest $request)
    {
        $project = Project::findOrFail($request->get("project_id"));
        $milestone = new Milestone([
            "ms_description" => $request->get("ms_description"),
            "start_date" => $request->get("start_date"),
            "due_date" => $request->get("due_date"),
        ]);
        $project->milestones()->save($milestone);

        return redirect()->route("ProjectMilestones", [
            "id" => $project->project_id,
        ])->with("status", "New milestone successfully created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = Project::all();
        $milestone = Milestone::findOrFail($id);

        $project = $milestone->project;
        $dueMilestones = $project->milestones->where('due_date', '<', Carbon::now());
        $milestones = $project->milestones->where('due_date', '>=', Carbon::now());
        $tasks = $milestone->tasks;

        return view("tasks.index",
        [
            'projects' => $projects,
            'pid' => $project->project_id,
            'dueMilestones' => $dueMilestones,
            'milestones' => $milestones,
            'mid' => $milestone->milestone_id,
            'tasks' => $tasks,
            'users' => $project->users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
