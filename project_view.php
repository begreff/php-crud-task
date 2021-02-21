<?php

include 'templates/header.php';
require 'templates/bootstrap.php';

use src\objects\Project;
use src\objects\Group;

$projectGateway = new Project($db->getConnection());
$groupGateway = new Group($db->getConnection());

$project_id = (int) $_GET['id'];
$project = $projectGateway->read($project_id);
$groups = $groupGateway->all($project_id);
$students = $projectGateway->students($project_id);
$unassignedStudents =  $projectGateway->unassignedStudents($project_id);

?>

<!-- Project info -->
<h1 class="my-3"><?= $project['title'] ?></h1>
<p>Project: <strong><?= $project['title'] ?></strong></p>
<p>Number of groups: <strong><?=  $project['num_groups'] ?></strong></p>
<p>Students per group: <strong><?=  $project['students_per_group'] ?></strong></p>
<input type="hidden" name="project_id" id="project_id" value="<?= $project_id ?>">

<!-- Students -->
<h1 class="my-3">Students</h1>
    <table id="studentsTable" class='table table-bordered'>
        <tbody>
            <thead class='thead-light'>
                <tr>
                    <th>Student</th>
                    <th>Group</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <?php if (count($students) > 0) : ?>
            <?php foreach($students as $student) : ?>
            <tr>
                <td><?= $student['firstname'] ?> <?= $student['lastname'] ?></td>
                <td><?= $student['group_number'] ?></td>
                <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="<?= $student['id'] ?>">Delete</button></td>
            </tr>
            <?php endforeach; ?>
        <?php else :?>
            <tr>
                <td colspan="4">No Students Found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="pt-3 pb-4">
        <button type="button" class="btn btn-primary"><a class="text-light" href="new_student.php?project_id=<?= $project_id ?>">Add Student</a></button>
    </div>

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

<button class="btn btn-primary"><a class="text-light" href="index.php">Back to homepage</a></button>

<script type="text/javascript">

    // Delete student
    $(document).on('click', '.delete', function(){
        let id = $(this).attr("id");
        console.log(id);
        let project_id = document.getElementById("project_id").value;
        if(confirm("Are you sure you want to remove this student?")) {
            $.ajax({
                url: "students.php?id=" + id,
                type: "DELETE",
                success: function(response) {
                    alert(response);
                    window.location.href = "project_view.php?id=" + project_id;
                }
            });
        }
    });

    // Auto refresh the page every 10 seconds
    setInterval('refreshPage()', 10000);

    function refreshPage() {
        location.reload();
    }
</script>

<?php include 'templates/footer.php' ?>
