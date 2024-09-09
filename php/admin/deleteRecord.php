<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fts");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID and table name from the query string
$id = $_GET['id'];
$tableName = $_GET['table'];

// Validate the table name to avoid SQL injection
$validTables = ['salaries', 'expenses', 'others'];
if (!in_array($tableName, $validTables)) {
    echo "Invalid table specified.";
    exit;
}

// Delete query
$sql = "DELETE FROM $tableName WHERE id='$id'"; // Adjust the table name as needed

if ($conn->query($sql) === TRUE) {
    header("Location: viewAll.php?table=$tableName"); // Redirect back after deletion
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>