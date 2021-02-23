<?php

namespace controllers;

use src\ProjectRepository;

class ProjectController
{
    private ProjectRepository $repo;

    public function __construct(ProjectRepository $repo)
    {
        $this->repo = $repo;
    }

    public function all() {
        return $this->repo->all();
    }

    public function read($id) {
        return $this->repo->read($id);
    }


}
