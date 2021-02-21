<?php

require 'vendor/autoload.php';
require 'config/conn.php';

use src\StudentRepository;

$studentGateway = new StudentRepository($db->getConnection());

$student_id = (int)$_POST['studentSelected'];
$project_id = (int)$_GET['project_id'];
$group_number= (int)$_GET['group_number'];

$studentGateway->update($student_id, $group_number);

header("Location: project_view.php?id=" . $_GET['project_id']);
