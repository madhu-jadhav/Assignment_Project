<?php
// Database connection
function dbConnect() {
    $host = 'localhost'; // Database host
    $dbname = 'employee'; // Database name
    $username = 'root'; // Database username
    $password = ''; // Database password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Function to insert a new employee
function insertEmployee($name, $email, $department_id) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare("INSERT INTO employees (name, email, department_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $department_id]);
    return $pdo->lastInsertId();
}

// Function to insert the contact details
function insertContact($employee_id, $phone_number) {
    $pdo = dbConnect();
    $stmt = $pdo->prepare("INSERT INTO contacts (employee_id, phone_number) VALUES (?, ?)");
    $stmt->execute([$employee_id, $phone_number]);
}

// Function to fetch departments
function fetchDepartments() {
    $pdo = dbConnect();
    $stmt = $pdo->query("SELECT * FROM departments");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
