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
$groups = $groupGateway->all($project_id);
$students = $projectGateway->students($project_id);
$unassignedStudents =  $projectGateway->unassignedStudents($project_id);

?>

<?php include 'views/project/detail.php' ?>

<?php require 'views/student/list.php' ?>

<!-- Groups -->
<div class='row'>
    <?php foreach ($groups as $groupNumber => $groupMembers) : ?>
        <div class='col-sm'>
            <table class='table table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <th>
                            Group <?= $groupNumber ?>
                            <?php if ($project['students_per_group'] == count($groupMembers)) :?>
                            - FULL
                            <?php endif; ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($groupMembers as $groupMember) : ?>
                    <tr>
                        <td><?= $groupMember['firstname'] ?> <?= $groupMember['lastname'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php $difference = $project['students_per_group'] - count($groupMembers); ?>
                <?php for ($j = 0; $j < $difference; $j++) {
                    echo "
                    <tr>
                        <td>
                            <form action='update_group_action.php?project_id={$project_id}&group_number={$groupNumber}' method='post'>
                                <select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>
                                <option value=''>Assign student</option>";
                                foreach ($unassignedStudents as $student) {
                                    $fullname = $student['firstname'] . " " . $student['lastname'];
                                    echo "<option value='{$student['id']}'>" . $fullname . "</option>";
                                }
                    echo "</select>
                           </form>
                        </td>
                    </tr>";
                } ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'views/layout/back_button.php' ?>
<?php include 'views/student/delete_js.php' ?>
<?php include 'views/layout/reload_js.php' ?>
<?php include 'views/layout/footer.php' ?>
