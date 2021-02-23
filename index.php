<?php

include 'partials/header.php';
require 'helpers/project_init.php';

$projectView->list();
$projectView->newProjectLink();

include 'partials/footer.php';
