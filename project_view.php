<?php

require 'vendor/autoload.php';
require 'config/conn.php';
require 'helpers/project_init.php';
require 'helpers/student_init.php';

include 'views/layout/header.php';

$project_id = (int) $_GET['id'];
$projectView->detail($project_id);

$project = $projectRepo->read($project_id);
$students = $studentController->all($project_id);
$unassignedStudents = $studentController->unassignedStudents($project_id);

echo "<input type='hidden' name='project_id' id='project_id' value='".$project_id."'>";

$studentView->list($project_id);
$studentView->newButton($project_id);

echo "
    <div class='row'>";
for ($i = 1; $i <= $project['num_groups']; $i++) {
    echo "    
        <div class='col-sm'>
        <table class='table table-bordered'>
        <thead class='thead-light'>
            <tr>
                <th>";
    $groupStudents = array_filter($students, function($student) use ($i) {
        return $student['group_number'] == $i;
    });
    echo "Group ".$i;
    if (count($groupStudents) == $project['students_per_group']) {
        echo " - FULL";
    }
    echo "    
                </th>
            </tr>
        </thead>
        <tbody>";

    foreach ($groupStudents as $student) {
        echo "
        <tr>
            <td>".$student['firstname']." ".$student['lastname']."</td>
        </tr>
        ";
    }
    $difference = $project['students_per_group'] - count($groupStudents);
    for ($j = 0; $j < $difference; $j++) {
        echo "
        <tr>
            <td>
                <form action='actions/update_group_action.php?group_number={$i}' method='post'>
                    <select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>
                        <option value=''>Assign student</option>";

        foreach ($unassignedStudents as $student) {
            $fullname = $student['firstname']." ".$student['lastname'];
            echo "<option value=".$student['id'].">".$fullname."</option>";
        }

        echo "</select>
           </form>
          </td>
        </tr>";
    }
    echo "
        </tbody>
        </table>
    </div>
    ";
}
echo "</div>";


include 'views/layout/back_to_homepage.php';
require 'views/layout/delete_student_js.html';
require 'views/layout/reload_js.html';
include 'views/layout/footer.php';
