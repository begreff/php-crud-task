<?php

namespace src\views;

use src\models\ProjectRepository;

class ProjectView
{
    private ProjectRepository $repo;

    public function __construct(ProjectRepository $repo)
    {
        $this->repo = $repo;
    }

    /*
     * Lists all projects.
     */
    public function list()
    {
        $projects = $this->repo->all();
        $output = "<h1 class='my-3'>All Projects</h1>";

        if ($projects) {
            // Display each project.
            foreach ($projects as $project) {
            $output .=
            "<div class='card my-3'>
                <div class='card-body'>
                    <li><a href='../project_view.php?id=".$project['id']."'>".$project['title']."</a></li>
                </div>
            </div>";
            }
        } else {
            $output .= "<p>There are no projects yet.</p>";
        }

        echo $output;
    }

    /*
     * Displays project info.
     */
    public function detail($id)
    {
        $project = $this->repo->read($id);
        $output = "
            <h1 class='my-3'>".$project['title']."</h1>
            <p>Project: <strong>".$project['title']."</strong></p>
            <p>Number of groups: <strong>".$project['num_groups']."</strong></p>
            <p>Students per group: <strong>".$project['students_per_group']."</strong></p>
            ";
        echo $output;
    }

    /*
     * Displays a form for creating a new project.
     */
    public function form()
    {
        echo "
        <h1 class='my-3'>Create New Project</h1>
        <div class='card my-3'>
            <div class='card-body'>
                <form action='src/actions/new_project_action.php' method='post'>
                    <div class='form-group'>
                        <label for='title'>Project Title</label>
                        <input type='text' class='form-control' id='title' name='titleInput' placeholder='Enter project title' required>
                    </div>
                    <div class='form-group'>
                        <label for='numOfGroups'>Number of Groups</label>
                        <input type='number' min='1' class='form-control' id='numOfGroups' name='numOfGroupsInput'  placeholder='Enter the number of groups' required>
                    </div>
                    <div class='form-group'>
                        <label for='studentsPerGroup'>Students per Group</label>
                        <input type='number' min='1' class='form-control' id='studentsPerGroup' name='studentsPerGroupInput' placeholder='Enter the number of students per group' required>
                    </div>
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </form>
            </div>
        </div>
        ";
    }

    /*
     * Button to creating a new project.
     */
    public function newButton()
    {
        echo "
        <button type='button' class='btn btn-primary'>
            <a href='../../new_project.php' class='text-light'>
                Add New Project
            </a>
        </button>
        ";
    }
}
