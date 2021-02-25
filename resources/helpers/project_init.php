<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/conn.php';

use src\models\ProjectRepository;
use src\controllers\ProjectController;

$projectRepo = new ProjectRepository($db->getConnection());
$projectController = new ProjectController($projectRepo);
