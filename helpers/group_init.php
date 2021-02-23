<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\GroupRepository;
use controllers\GroupController;
use views\GroupView;

$groupRepo = new GroupRepository($db->getConnection());
$groupController = new GroupController($groupRepo);
$groupView = new GroupView($groupRepo, $groupController);
