<?php

include 'views/layout/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';

use src\ProjectRepository;
use src\GroupRepository;

$projectGateway = new ProjectRepository($db->getConnection());
$groupGateway = new GroupRepository($db->getConnection());

$project_id = (int) $_GET['id'];
$project = $projectGateway->read($project_id);

$students = $projectGateway->students($project_id);
$unassignedStudents =  $projectGateway->unassignedStudents($project_id);

$groups = $groupGateway->count($project_id);
$students = $groupGateway->all($project_id);

include 'views/project_output.php';
include 'views/student_output.php';

showDetail($project);
echo "<input type='hidden' name='project_id' id='project_id' value='".$project_id."'>";
studentTableList($students);
newStudentButton($project_id);
?>




<div class="row">
    <?php foreach ($groups as $group) : ?>
    <div class='col-sm'>
        <table class='table table-bordered'>
        <thead class='thead-light'>
            <tr>
                <th>
            Group <?= $group['group_number'] ?>
            <?php if ($group['capacity'] == $group['count']) : ?>
                - FULL
            <?php endif; ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student) : ?>
                <?php if ($student['group_number'] == $group['group_number']) :?>
                    <tr>
                        <td><?= $student['firstname']." ".$student['lastname'] ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php
            $difference = $group['capacity'] - $group['count'];
            for ($i = 0; $i < $difference; $i++) {
                $output = "<tr>";
                $output .= "<td>";
                $output .= "<form action='update_group_action.php?group_number={$group['group_number']}' method='post'>";
                $output .= "<select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>";
                $output .= "<option value=''>Assign student</option>";
                echo $output;

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
    </div>";
            ?>
    <?php endforeach; ?>
</div>


<?php
include 'views/layout/back_button.php';
include 'views/student/delete_js.php';
include 'views/layout/reload_js.php';
include 'views/layout/footer.php';
