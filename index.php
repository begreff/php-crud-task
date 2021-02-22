<?php
include 'views/layout/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';
include 'views/project_output.php';

use src\ProjectRepository;
$projectGateway = new ProjectRepository($db->getConnection());
$projects = $projectGateway->all();

listProjects($projects);

include 'views/project/new_button.php';
include 'views/layout/footer.php';
