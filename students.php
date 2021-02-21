<?php

// CORS headers
header('Access-Control-Allow-Origin: *');

require 'vendor/autoload.php';
require 'config/conn.php';

use src\StudentRepository;

// Create object for accessing the student table in the database
$studentGateway = new StudentRepository($db->getConnection());

// Create an API variable to get the HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// Get the ID from the url
$id = intval($_GET['id'] ?? '');
$project_id = intval($_GET['project_id'] ?? '');

// Get all or a single student from the database
if ($api == 'GET' and $id != 0) {
    $data = $studentGateway->read($id);
    echo json_encode($data);
}

// Get all or a single student from the database
if ($api == 'GET' and $id == 0) {
    $data = $studentGateway->all();
    echo json_encode($data);
}

// Add a new student to the database
if ($api == 'POST') {
    $firstname = $db->testInput($_POST['firstname']);
    $lastname = $db->testInput($_POST['lastname']);
    $project_id = $db->testInput($_POST['project_id']);

    if ($studentGateway->create($firstname, $lastname, $project_id)) {
        echo 'StudentRepository added successfully.';
    } else {
        echo "Failed to create student.";
    }
}

// Update a student in the database
if ($api == 'PUT') {
    parse_str(file_get_contents('php://input'), $post_input);

    $firstname = $db->testInput($post_input['firstname']);
    $lastname = $db->testInput($post_input['lastname']);
    $group_number = $db->testInput($post_input['group_number']);

    if ($id != null) {
        if ($studentGateway->update($id, $group_number)) {
            echo 'StudentRepository updated successfully.';
        } else {
            echo "Failed to update student.";
        }
    } else {
        echo 'StudentRepository not found.';
    }
}

// Delete student from the database
if ($api == 'DELETE') {
    if ($id != 0) {
        if ($studentGateway->delete($id)) {
            echo 'StudentRepository deleted successfully.';
        } else {
            echo 'Failed to delete student.';
        }
    } else {
        echo 'StudentRepository not found.';
    }
}
