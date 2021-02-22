<?php

require 'vendor/autoload.php';
require 'config/conn.php';

use src\StudentRepository;

$studentGateway = new StudentRepository($db->getConnection());

$student_id = (int)$_POST['studentSelected'];
$group_number= (int)$_GET['group_number'];

$studentGateway->update($student_id, $group_number);

header('Location: '.$_SERVER['HTTP_REFERER']);
