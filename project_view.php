<?php

include 'partials/header.php';

require 'helpers/project_init.php';
require 'helpers/student_init.php';
require 'helpers/group_init.php';

$project_id = (int) $_GET['id'];
$project = $projectRepo->read($project_id);
$numGroups = $project['num_groups'];
$studentsPerGroup = $project['students_per_group'];

$projectView->detail($project_id);
$studentView->list($project_id);
$studentView->newStudentLink($project_id);
$groupView->list($project_id, $numGroups, $studentsPerGroup);

include 'partials/back_to_homepage.php';
require 'partials/delete_student_js.html';
require 'partials/reload_js.html';
include 'partials/footer.php';
