<?php

require_once __DIR__.'/../../config/init.php';

use src\models\StudentRepository;

$studentRepo = new StudentRepository($db->getConnection());

$student_id = (int)$_POST['studentSelected'];
$group_number= (int)$_GET['group_number'];

$studentRepo->update($student_id, $group_number);

header('Location: '.$_SERVER['HTTP_REFERER']);
