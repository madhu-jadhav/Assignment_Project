<?php
// Include the utility functions
include 'db_functions.php';

// Fetch departments and return them as options
$departments = fetchDepartments();

foreach ($departments as $department) {
    echo "<option value='" . $department['id'] . "'>" . $department['name'] . "</option>";
}
?>
