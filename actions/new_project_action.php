<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\ProjectRepository;
use src\GroupRepository;

$projectGateway = new ProjectRepository($db->getConnection());
$groupGateway = new GroupRepository($db->getConnection());

// create project
$id = $projectGateway->create([
    'title' => $_POST['titleInput'],
    'num_groups' => $_POST['numOfGroupsInput'],
    'students_per_group' => $_POST['studentsPerGroupInput']
]);

// create and assign groups to project
if ($id) {
    for ($i = 1; $i <= $_POST['numOfGroupsInput']; $i++) {
        $groupGateway->create([
            'project_id' => $id,
            'group_number' => $i,
        ]);
    }
}

header('Location: ../index.php');
