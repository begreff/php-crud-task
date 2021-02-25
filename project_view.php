<?php

include 'views/partials/header.php';
require_once 'resources/helpers/project_init.php';
require_once 'resources/helpers/student_init.php';
require_once 'resources/helpers/group_init.php';

$projectID = (int) $_GET['id'];

$projectController->detail($projectID);
$studentController->list($projectID);
$studentController->newStudentLink($projectID);
$groupController->all($projectID);

include 'views/partials/back_to_homepage.php';
require 'views/partials/delete_student_js.html';
require 'views/partials/reload_js.html';
include 'views/partials/footer.php';
