<?php

require 'vendor/autoload.php';
require 'config/conn.php';
include 'views/student_output.php';

include 'views/layout/header.php';

use src\ProjectRepository;

$projectRepo = new ProjectRepository($db->getConnection());
$project_id = (int) $_GET['project_id'];
$project = $projectRepo->read($project_id);

studentForm($project);

include 'views/layout/back_to_homepage.php';
require 'views/layout/create_student_js.html';
include 'views/layout/footer.php';
