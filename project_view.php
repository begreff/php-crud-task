<?php

include 'resources/partials/header.php';

require 'resources/helpers/project_init.php';
require 'resources/helpers/student_init.php';
require 'resources/helpers/group_init.php';
require 'resources/helpers/retrieve_project.php';

$projectView->detail($project_id);
$studentView->list($project_id);
$studentView->newStudentLink($project_id);
$groupView->list($project);

include 'resources/partials/back_to_homepage.php';
require 'resources/partials/delete_student_js.html';
require 'resources/partials/reload_js.html';
include 'resources/partials/footer.php';
