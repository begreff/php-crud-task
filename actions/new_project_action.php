<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\ProjectRepository;
use src\GroupRepository;

$projectRepo = new ProjectRepository($db->getConnection());
$groupRepo = new GroupRepository($db->getConnection());

// Create project.
$id = $projectRepo->create([
    'title' => $_POST['titleInput'],
    'num_groups' => $_POST['numOfGroupsInput'],
    'students_per_group' => $_POST['studentsPerGroupInput']
]);

// Create and assign groups to project.
if ($id) {
    for ($i = 1; $i <= $_POST['numOfGroupsInput']; $i++) {
        $groupRepo->create([
            'project_id' => $id,
            'group_number' => $i,
        ]);
    }
}

header('Location: ../index.php');
