<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\StudentRepository;
use views\StudentView;

$studentRepo = new StudentRepository($db->getConnection());
$studentView = new StudentView($studentRepo);
