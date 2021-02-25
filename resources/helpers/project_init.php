<?php

require_once __DIR__.'/../../config/init.php';

use src\models\ProjectRepository;
use src\controllers\ProjectController;

$projectRepo = new ProjectRepository($db->getConnection());
$projectController = new ProjectController($projectRepo);
