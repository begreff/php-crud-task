<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/conn.php';

use src\GroupRepository;
use views\GroupView;

$groupRepo = new GroupRepository($db->getConnection());
$groupView = new GroupView($groupRepo);
