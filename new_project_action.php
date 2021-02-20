<?php

require 'templates/bootstrap.php';

use src\objects\Project;
$projectGateway = new Project($db->getConnection());


$projectGateway->create([
    'title' => $_POST['titleInput'],
    'num_groups' => $_POST['numOfGroupsInput'],
    'students_per_group' => $_POST['studentsPerGroupInput']
]);

header('Location: index.php');
