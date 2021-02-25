<?php

namespace src\controllers;

use src\models\StudentRepository;

class StudentController
{
    private StudentRepository $repo;

    public function __construct(StudentRepository $repo)
    {
        $this->repo = $repo;
    }

    /*
     * Lists a table of all students on a project.
     */
    public function list($project_id)
    {
        $students = $this->repo->all($project_id);

        require __DIR__ . '/../../views/student/list.php';
    }

    /*
    * Displays a form for creating a new student.
    */
    public function form($projectID)
    {
        require __DIR__ . '/../../views/student/form.php';
    }

    /*
     * Button to creating a new student.
     */
    public function newStudentLink($projectID)
    {
        require __DIR__ . '/../../views/student/link_to_new.php';
    }
}
