<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\StudentRepository;

$studentRepo = new StudentRepository($db->getConnection());

$student_id = (int)$_POST['studentSelected'];
$group_number= (int)$_GET['group_number'];

$studentRepo->update($student_id, $group_number);

header('Location: '.$_SERVER['HTTP_REFERER']);
