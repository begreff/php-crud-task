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

?>

<h1 class="my-3"><?= $project['title'] ?></h1>

<p>Project: <strong><?= $project['title'] ?></strong></p>
<p>Number of groups: <strong><?=  $project['num_groups'] ?></strong></p>
<p>Students per group: <strong><?=  $project['students_per_group'] ?></strong></p>

<div class='row'>
    <?php foreach ($groups as $group) : ?>
        <div class='col-sm'>
            <table class='table table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <th>Group <?= $group['group_number'] ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < $project['students_per_group']; $i++) {
                    echo "
                    <tr>
                        <td>Assign a student</td>
                    </tr>";
                } ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<button class="btn btn-primary"><a class="text-light" href="index.php">Back to homepage</a></button>

<?php include 'templates/footer.php' ?>


