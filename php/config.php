<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "fts";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($database);


// Create the users table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    department VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Insert the 'admin' user if it doesn't exist
$username = "admin";
$password = "admin123";
$role = "admin";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    if ($conn->query($sql) !== TRUE) {
        die("Error inserting data: " . $conn->error);
    }
}


$sqlCreateTable = "CREATE TABLE IF NOT EXISTS hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hospital_name VARCHAR(255) UNIQUE
)";

if ($conn->query($sqlCreateTable) !== TRUE) {
    echo "Table 'hospitals' failed to create";
}
    
    
        $sql = "INSERT INTO hospitals (hospital_name) VALUES 
        ('St. kizito'), 
        ('St. Therese'), 
        ('St. Zelie'), 
        ('Health Center')
        ON DUPLICATE KEY UPDATE hospital_name = hospital_name";
        if ($conn->query($sql) !== TRUE) {
            die("Error inserting data: " . $conn->error);
        }
$conn->close();
?>