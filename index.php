<?php
include 'views/partials/header.php';
require 'resources/helpers/project_init.php';

$projectController->list();
$projectController->newProjectLink();

include 'views/partials/footer.php';
