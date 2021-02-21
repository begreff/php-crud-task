<?php
require 'templates/bootstrap.php';
header('Access-Control-Allow-Origin: *');

use src\objects\Student;

$studentGateway = new Student($db->getConnection());

switch($_GET['action']) {
    case 'all':
        $data = $studentGateway->all($_GET["project_id"]);
        break;
    case 'create':
        $data = $studentGateway->create();
        break;
    case 'read':
        $data = $studentGateway->read($_GET["id"]);
        break;
    case 'update':
        $data = $studentGateway->update();
        break;
    case 'delete':
        $data = $studentGateway->delete($_GET["id"]);
        break;
}

echo json_encode($data);
