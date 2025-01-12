<?php
// Include the utility functions
include 'db_functions.php';

// Get data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$department_id = $_POST['department'];
$phone = $_POST['phone'];

// Validate the data
if (empty($name) || empty($email) || empty($department_id) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

try {
    // Insert employee
    $employee_id = insertEmployee($name, $email, $department_id);

    // Insert contact information
    insertContact($employee_id, $phone);

    // Respond with success message
    echo json_encode(['success' => true, 'message' => 'Employee added successfully!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>
