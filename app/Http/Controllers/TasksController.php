<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
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
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function store(Project $project, Task $task)
    {
        $input = Input::all();
        $input['project_id'] = $project->id;
        Task::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @internal param Project $project
     * @internal param int $id
     */
    public function show(Project $project, Task $task)
    {
        return $task;
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
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param int $id
     */
    public function update(Project $project, Task $task)
    {
        $input = Input::all();
        $input['project_id'] = $project->id;
        $task->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
    }
}
