<?php

include 'templates/header.php';
require 'templates/bootstrap.php';

use src\objects\Project;

$projectGateway = new Project($db->getConnection());
$id = (int) $_GET['id'];
$project = $projectGateway->read($id);

?>

<h1 class="my-3"><?= $project['title'] ?></h1>

<p>Project: <strong><?= $project['title'] ?></strong></p>
<p>Number of groups: <strong><?=  $project['num_groups'] ?></strong></p>
<p>Students per group: <strong><?=  $project['students_per_group'] ?></strong></p>

<button class="btn btn-primary"><a class="text-light" href="index.php">Back to homepage</a></button>

<?php include 'templates/footer.php' ?>


