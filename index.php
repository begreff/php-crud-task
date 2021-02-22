<?php
include 'views/layout/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';

use src\ProjectRepository;
$projectGateway = new ProjectRepository($db->getConnection());
$projects = $projectGateway->all();

include 'views/project/list.php';
include 'views/project/new_button.php';
include 'views/layout/footer.php';
