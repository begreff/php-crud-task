<?php

namespace src\controllers;

use src\models\ProjectRepository;

class ProjectController
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

        require __DIR__ . '/../../views/project/list.php';
    }

    /*
     * Displays project info.
     */
    public function detail($id)
    {
        $project = $this->repo->read($id);

        require __DIR__ . '/../../views/project/detail.php';
    }

    /*
     * Displays a form for creating a new project.
     */
    public function form()
    {
        require __DIR__ . '/../../views/project/form.php';
    }

    /*
     * Button to creating a new project.
     */
    public function newProjectLink()
    {
        require __DIR__ . '/../../views/project/link_to_new.php';
    }
}
