<?php

function newStudentButton($projectID) {
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

function studentForm($project) {
    echo "
    <h1 class='my-3'>Add New Student to ".$project['title']."</h1>
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
    
                <input type='hidden' name='project_id' id='project_id' value=".$project['id'].">
                <input type='submit' name='button_action' id='button_action' class='btn btn-info' value='Create' />
            </form>
        </div>
    </div>
    ";
}

function studentTableList($students) {
    echo "
    <h1 class='my-3'>Students</h1>
    <table id='studentsTable' class='table table-bordered'>
        <tbody>
        <thead class='thead-light'>
        <tr>
            <th>Student</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
        </thead>";
    if (count($students) > 0) {
        foreach($students as $student) {
            echo "
            <tr>
                <td>" . $student['firstname'] . " " . $student['lastname'] . "</td>
                <td>" . $student['group_number'] . "</td>
                <td>
                    <button type='button' name='delete' class='btn 
                        btn-danger btn-xs delete' id=".$student['id'].">
                        Delete
                    </button>
                </td>
            </tr>
            ";
        }
    } else {
        echo "
        <tr>
            <td colspan='4'>No Students Found</td>
        </tr>
        ";
    }
    echo "
        </tbody>
    </table>
    ";
}
