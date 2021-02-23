<?php

include 'views/layout/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';
include 'views/student_output.php';
include 'views/layout/output_helpers.php';

use src\ProjectRepository;

$projectRepo = new ProjectRepository($db->getConnection());
$project_id = (int) $_GET['project_id'];
$project = $projectRepo->read($project_id);

studentForm($project);
include 'views/layout/back_to_homepage.php';
includeJS('assets/createStudent.js');

include 'views/layout/footer.php';
