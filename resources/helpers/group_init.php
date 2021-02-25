<?php

require_once __DIR__.'/../../config/init.php';

use src\models\GroupRepository;
use src\controllers\GroupController;

$groupRepo = new GroupRepository($db->getConnection());
$groupController = new GroupController($groupRepo);
