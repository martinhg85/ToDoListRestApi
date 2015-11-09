<?php

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Tasks extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    private $testData = [
        'name' => 'test_task_name',
        'completed' => 1,
        'description' => 'test_task_description'
    ];

    /**
     * Create a new project
     *
     * @return Project
     */
    private function createProject()
    {
        $project = new Project();
        $project->name = 'test_project';
        $project->save();
        return $project;
    }

    /**
     * Create a new task
     * @param Project $project
     * @return Task
     * @internal param $projectId
     */
    private function createTask(Project $project)
    {
        $task = new Task();
        $task->project_id = $project->id;
        $task->name = 'test_task_name';
        $task->completed = true;
        $task->description = 'test_task_description';
        $task->save();
        return $task;
    }

    /**
     * Get a tasks
     *
     * @return void
     */
    public function testGetTask()
    {
        $project = $this->createProject();
        $task = $this->createTask($project);

        $this->get('/projects/' . $project->id . '/tasks/' . $task->id)
            ->seeStatusCode(200)
            ->seeJson($this->testData);

    }

    /**
     * Get a tasks list
     *
     * @return void
     */
    public function testGetTasks()
    {
        $project = $this->createProject();
        $this->createTask($project);

        $this->get('/projects/' . $project->id . '/tasks')
            ->seeStatusCode(200)
            ->seeJson($this->testData);

    }

    /**
     * Add a new task
     *
     * @return void
     */
    public function testAddTask()
    {
        $project = $this->createProject();

        $this->post('/projects/' . $project->id . '/tasks',
            $this->testData
        )
            ->seeStatusCode(200)
            ->seeInDatabase('tasks', $this->testData);

    }

    /**
     * Update a task
     *
     * @return void
     */
    public function testUpdateTask()
    {
        $project = $this->createProject();
        $task = $this->createTask($project);

        $this->put('/projects/' . $project->id . '/tasks/' . $task->id,
            [
                'name' => 'new_test_task_name',
            ])
            ->seeStatusCode(200)
            ->seeInDatabase('tasks', ['name' => 'new_test_task_name']);

    }

    /**
     * Get a projects list
     *
     * @return void
     */
    public function testRemoveTask()
    {
        $project = $this->createProject();
        $task = $this->createTask($project);

        $this->delete('/projects/' . $project->id . '/tasks/' . $task->id)
            ->seeStatusCode(200)
            ->notSeeInDatabase('tasks', $this->testData);

    }
}
