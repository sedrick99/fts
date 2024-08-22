<?php
Include "config.php";

If ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["site_name"] = $_POST["site_name"];
    $_SESSION["site_url"] = $_POST["site_url"];

    // Here you can save data to the database
    $db->query("CREATE DATABASE IF NOT EXISTS fts") ;
    $db->select_db($_SESSION['db_name']);
    $db->query("CREATE TABLE IF NOT EXISTS users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(10) NOT NULL,
    role VARCHAR(10) NOT NULL
    )");
    $db->query("INSERT INTO users ('username', password, role) VALUES ('$)");
    // Create tables and save admin data
    // …
 

    Echo "Installation complete!";
    Session_destroy();
}
?>
<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Installation Complete</title>
</head>
<body>
    <h2>Step 4: Complete</h2>
    <p>Installation completed successfully!</p>
    <h1>proceed to login</h1>
    header('location: \fts\php\login.php');
    <button><a href="\fts\php\login.php">proceed</a></button>
</body>
</html>
