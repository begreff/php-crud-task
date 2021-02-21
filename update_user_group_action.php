<?php

require 'templates/bootstrap.php';

use src\objects\Student;

$studentGateway = new Student($db->getConnection());

$student_id = (int)$_POST['studentSelected'];
$project_id = (int)$_GET['project_id'];
$group_number= (int)$_GET['group_number'];

$studentGateway->updateGroup('students', $student_id, [
    'group_number' => $group_number
]);
header("Location: project_view.php?id=" . $_GET['project_id']);
