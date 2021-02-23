<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/conn.php';

use src\models\ProjectRepository;
use src\models\GroupRepository;

$projectRepo = new ProjectRepository($db->getConnection());
$groupRepo = new GroupRepository($db->getConnection());

// Create project.
$id = $projectRepo->create([
    'title' => $db->sanitizeInput($_POST['titleInput']),
    'num_groups' => $db->sanitizeInput($_POST['numOfGroupsInput']),
    'students_per_group' => $db->sanitizeInput($_POST['studentsPerGroupInput'])
]);

// Create and assign groups to project.
$numGroups = $db->sanitizeInput($_POST['numOfGroupsInput']);
if ($id) {
    for ($i = 1; $i <= $numGroups; $i++) {
        $groupRepo->create([
            'project_id' => $id,
            'group_number' => $i,
        ]);
    }
}

header('Location: ../../index.php');
