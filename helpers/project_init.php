<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\ProjectRepository;
use controllers\ProjectController;
use views\ProjectView;

$projectRepo = new ProjectRepository($db->getConnection());
$projectController = new ProjectController($projectRepo);
$projectView = new ProjectView($projectRepo, $projectController);
