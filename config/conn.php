<?php

use config\Database;

$config = require 'config/config.php';
$db = new Database($config['database']);
