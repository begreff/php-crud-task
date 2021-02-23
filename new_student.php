<?php

require 'helpers/student_init.php';
include 'views/layout/header.php';

$projectID = (int) $_GET['project_id'];

$studentView->form($projectID);

include 'views/layout/back_to_homepage.php';
require 'views/layout/create_student_js.html';
include 'views/layout/footer.php';
