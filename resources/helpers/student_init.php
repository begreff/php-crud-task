<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/conn.php';

use src\models\StudentRepository;
use src\controllers\StudentController;

$studentRepo = new StudentRepository($db->getConnection());
$studentController = new StudentController($studentRepo);
