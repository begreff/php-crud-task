<?php

include 'views/partials/header.php';
require_once 'resources/helpers/student_init.php';

$projectID = (int) $_GET['project_id'];

$studentController->form($projectID);

include 'views/partials/back_to_homepage.php';
require 'views/partials/create_student_js.html';
include 'views/partials/footer.php';
