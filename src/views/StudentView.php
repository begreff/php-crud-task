<?php

namespace src\views;

use src\models\StudentRepository;

class StudentView
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

        // Table head.
        $output =
            "
            <h1 class='my-3'>Students</h1>
            <table id='studentsTable' class='table table-bordered'>
                <thead class='thead-light'>
                <tr>
                    <th>Student</th>
                    <th>Group</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
            ";

        // Table body.
        if (count($students) > 0) {
            // Display each student's information in a table row.
            foreach($students as $student) {
                $output .= "
                    <tr>
                        <td>" . $student['firstname'] . " " . $student['lastname'] . "</td>
                        <td>" . $student['group_number'] . "</td>
                        <td>
                            <input type='hidden' name='project_id' id='project_id' value=".$project_id.">
                            <button type='button' name='delete' class='btn 
                                btn-danger btn-xs delete' id=".$student['id'].">
                                Delete
                            </button>
                        </td>
                    </tr>";
            }
        } else {
            $output .= "
                    <tr>
                        <td colspan='4'>No Students Found</td>
                    </tr>";
        }

        $output .= "
            </tbody>
        </table>";

        echo $output;
    }

    /*
     * Displays a form for creating a new student.
     */
    public function form($projectID)
    {
        echo "
        <h1 class='my-3'>Add New Student</h1>
        <div class='card my-3'>
            <div class='card-body'>
                <form method='post' id='studentForm'>
                    <div class='form-group'>
                        <label>Enter First Name</label>
                        <input type='text' name='firstname' id='firstname' class='form-control' required />
                    </div>
                    <div class='form-group'>
                        <label>Enter Last Name</label>
                        <input type='text' name='lastname' id='lastname' class='form-control' required />
                    </div>
                    <input type='hidden' name='project_id' id='project_id' value=".$projectID.">
                    <input type='submit' name='button_action' id='button_action' class='btn btn-info' value='Create' />
                </form>
            </div>
        </div>
        ";
    }

    /*
     * Button to creating a new student.
     */
    public function newStudentLink($projectID)
    {
        echo "
        <div class='pt-3 pb-4'>
            <button type='button' class='btn btn-primary'>
            <a class='text-light' href='new_student.php?project_id=".$projectID."'>
            Add Student
            </a>
            </button>
        </div>
        ";
    }
}
