<?php

require 'vendor/autoload.php';
require 'config/conn.php';
include 'views/project_output.php';

include 'views/layout/header.php';

use src\ProjectRepository;
$projectRepo = new ProjectRepository($db->getConnection());
$projects = $projectRepo->all();

listProjects($projects);

include 'views/project/new_button.php';
include 'views/layout/footer.php';
