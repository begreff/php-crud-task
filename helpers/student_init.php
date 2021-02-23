<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\StudentRepository;
use controllers\StudentController;
use views\StudentView;

$studentRepo = new StudentRepository($db->getConnection());
$studentController = new StudentController($studentRepo);
$studentView = new StudentView($studentRepo, $studentController);
