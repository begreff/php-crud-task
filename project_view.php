<?php

require 'vendor/autoload.php';
require 'config/conn.php';
include 'views/layout/header.php';
include 'views/project_output.php';
include 'views/student_output.php';
include 'views/group_output.php';
include 'views/layout/output_helpers.php';

use src\ProjectRepository;
use src\GroupRepository;

$projectGateway = new ProjectRepository($db->getConnection());
$groupGateway = new GroupRepository($db->getConnection());

$project_id = (int) $_GET['id'];
$project = $projectGateway->read($project_id);

$students = $projectGateway->students($project_id);
$unassignedStudents =  $projectGateway->unassignedStudents($project_id);

$groups = $groupGateway->count($project_id);
$groupStudents = $groupGateway->all($project_id);

showDetail($project);
echo "<input type='hidden' name='project_id' id='project_id' value='".$project_id."'>";
studentTableList($students);
newStudentButton($project_id);
groupList($groups, $groupStudents, $unassignedStudents);
include 'views/layout/back_to_homepage.php';
includeJS('assets/deleteStudent.js');
includeJS('assets/reload.js');

include 'views/layout/footer.php';
