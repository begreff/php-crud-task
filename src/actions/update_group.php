<?php

require_once __DIR__.'/../../config/init.php';

use src\models\StudentRepository;

$studentRepo = new StudentRepository($db->getConnection());

$studentID = (int)$_POST['studentSelected'];
$groupNumber= (int)$_GET['number'];

$studentRepo->update($studentID, $groupNumber);

header('Location: '.$_SERVER['HTTP_REFERER']);
