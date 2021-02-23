<?php

require 'helpers/project_init.php';
require 'helpers/student_init.php';
require 'helpers/group_init.php';

include 'views/layout/header.php';

$project_id = (int) $_GET['id'];

$projectView->detail($project_id);
$studentView->list($project_id);
$studentView->newButton($project_id);
$groupView->list($project_id);

include 'views/layout/back_to_homepage.php';
require 'views/layout/delete_student_js.html';
require 'views/layout/reload_js.html';
include 'views/layout/footer.php';
