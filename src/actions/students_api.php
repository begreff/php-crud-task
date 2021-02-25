<?php

// CORS headers
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../../config/init.php';

use src\models\StudentRepository;

// Create object for accessing the student table in the database
$studentRepo = new StudentRepository($db->getConnection());

// Create an API variable to get the HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// Get the ID from the url
$id = intval($_GET['id'] ?? '');
$project_id = intval($_GET['project_id'] ?? '');

// Add a new student to the database
if ($api == 'POST') {

    $firstname = $db->sanitizeInput($_POST['firstname']);
    $lastname = $db->sanitizeInput($_POST['lastname']);
    $project_id = $db->sanitizeInput($_POST['project_id']);

    if ($studentRepo->find($firstname, $lastname)[1] == 1) {
        echo "Student with this name already exists on the system.";
    } else {
        if ($studentRepo->create($firstname, $lastname, $project_id)) {
            echo 'Student added successfully.';
        } else {
            echo "Failed to create student.";
        }
    }
}

// Delete student from the database
if ($api == 'DELETE') {
    if ($id != 0) {
        if ($studentRepo->delete($id)) {
            echo 'Student deleted successfully.';
        } else {
            echo 'Failed to delete student.';
        }
    } else {
        echo 'Student not found.';
    }
}
