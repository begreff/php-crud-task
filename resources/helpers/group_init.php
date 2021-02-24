<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/conn.php';

use src\models\GroupRepository;
use src\views\GroupView;

$groupRepo = new GroupRepository($db->getConnection());
$groupView = new GroupView($groupRepo);
