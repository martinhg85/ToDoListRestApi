<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = Input::all();
        Project::create($input);
    }

    /**
     * Display the specified resource.
     *
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Project $project)
    {
        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param int $id
     */
    public function update(Project $project)
    {
        $project->update(Input::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }
}
