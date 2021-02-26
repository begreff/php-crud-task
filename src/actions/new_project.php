<?php

require_once __DIR__.'/../../config/init.php';

use src\models\ProjectRepository;
use src\models\GroupRepository;

$projectRepo = new ProjectRepository($db->getConnection());
$groupRepo = new GroupRepository($db->getConnection());

// Create project.
$title = $db->sanitizeInput($_POST['titleInput']);
$numGroups = $db->sanitizeInput($_POST['numOfGroupsInput']);
$studentsPerGroup = $db->sanitizeInput($_POST['studentsPerGroupInput']);

$id = $projectRepo->create($title, $numGroups, $studentsPerGroup);

// Create and assign groups to project.
if ($id) {
    for ($i = 1; $i <= $numGroups; $i++) {
        $groupRepo->create($id, $i);
    }
}

header('Location: ../../index.php');
