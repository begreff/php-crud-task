<?php

include 'views/layout/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';

use src\ProjectRepository;

$projectGateway = new ProjectRepository($db->getConnection());
$project_id = (int) $_GET['project_id'];
$project = $projectGateway->read($project_id);

?>

<?php require 'views/student/form.php' ?>
<?php include 'views/layout/back_button.php' ?>
<?php include 'views/student/create_js.php' ?>
<?php include("views/layout/footer.php"); ?>


