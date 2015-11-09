<?php

use App\Project;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectsTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * Get a projects
     *
     * @return void
     */
    public function testGetProject()
    {
        $project = new Project();
        $project->name = 'test_project';
        $project->save();

        echo "el id es".($project->id);
        $this->get('/projects/'.$project->id)
            ->seeStatusCode(200)
            ->seeJson([
                'name' => 'test_project',
            ]);

    }

    /**
     * Get a projects list
     *
     * @return void
     */
    public function testGetProjects()
    {
        Project::insert([
            'name' => 'test_project',
        ]);

        $this->get('/projects')
            ->seeStatusCode(200)
            ->seeJson([
                'name' => 'test_project',
            ]);

    }

    /**
     * Add a new project test
     *
     * @return void
     */
    public function testAddProject()
    {
        $this->post('/projects',
            [
                'name' => 'test_project',
            ]
        )
            ->seeStatusCode(200)
            ->seeInDatabase('projects',['name'=>'test_project']);

    }

    /**
     * Get a projects list
     *
     * @return void
     */
    public function testUpdateProject()
    {
        $project = new Project();
        $project->name = 'test_project';
        $project->save();

        $this->put('/projects/'.$project->id,
            [
                'name'=>'new_test_project',
            ])
            ->seeStatusCode(200)
            ->seeInDatabase('projects',[
                'name' => 'new_test_project',
            ]);

    }

    /**
     * Get a projects list
     *
     * @return void
     */
    public function testRemoveProject()
    {
        $project = new Project();
        $project->name = 'test_project';
        $project->save();

        $this->delete('/projects/'.$project->id)
            ->seeStatusCode(200)
            ->notSeeInDatabase('projects',[
                'name' => 'test_project',
            ]);

    }
}
