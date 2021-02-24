<?php

include 'resources/partials/header.php';
require 'resources/helpers/project_init.php';

$projectView->list();
$projectView->newProjectLink();

include 'resources/partials/footer.php';
