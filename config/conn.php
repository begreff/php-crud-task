<?php

use config\Database;

$config = require __DIR__.'/config.php';
$db = new Database($config['database']);
