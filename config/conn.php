<?php

use config\Database;

$config = require_once __DIR__.'/config.php';
$db = new Database($config['database']);
