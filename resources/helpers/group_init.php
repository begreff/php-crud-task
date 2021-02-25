<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/conn.php';

use src\models\GroupRepository;
use src\controllers\GroupController;

$groupRepo = new GroupRepository($db->getConnection());
$groupController = new GroupController($groupRepo);
