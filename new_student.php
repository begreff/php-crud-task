<?php

include 'partials/header.php';
require 'helpers/student_init.php';

$projectID = (int) $_GET['project_id'];

$studentView->form($projectID);

include 'partials/back_to_homepage.php';
require 'partials/create_student_js.html';
include 'partials/footer.php';
