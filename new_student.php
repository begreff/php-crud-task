<?php

include 'resources/partials/header.php';
require 'resources/helpers/student_init.php';

$projectID = (int) $_GET['project_id'];

$studentView->form($projectID);

include 'resources/partials/back_to_homepage.php';
require 'resources/partials/create_student_js.html';
include 'resources/partials/footer.php';
