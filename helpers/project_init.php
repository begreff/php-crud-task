<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\models\ProjectRepository;
use src\views\ProjectView;

$projectRepo = new ProjectRepository($db->getConnection());
$projectView = new ProjectView($projectRepo);
