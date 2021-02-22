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

include 'views/project/detail.php';
require 'views/student/list.php';
include 'views/group/list.php';
include 'views/layout/back_button.php';
include 'views/student/delete_js.php';
include 'views/layout/reload_js.php';
include 'views/layout/footer.php';
