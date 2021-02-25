<?php

require_once __DIR__.'/../../config/init.php';

use src\models\StudentRepository;
use src\controllers\StudentController;

$studentRepo = new StudentRepository($db->getConnection());
$studentController = new StudentController($studentRepo);
