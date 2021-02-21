<?php
include 'views/layout/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';

use src\ProjectRepository;
$projectGateway = new ProjectRepository($db->getConnection());
$projects = $projectGateway->all();

?>

<?php require 'views/project/list.php' ?>

<?php include 'views/project/new_button.php' ?>
<?php include 'views/layout/footer.php';
