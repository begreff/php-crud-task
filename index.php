<?php

require 'vendor/autoload.php';
require 'config/conn.php';
require 'helpers/project_init.php';

include 'views/layout/header.php';

$projectView->list();
$projectView->newButton();

include 'views/layout/footer.php';
