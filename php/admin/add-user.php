<?php
$conn = new mysqli("localhost", "root", "", "fts") or die ('connection failed');

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Name"];
    $hashedPassword = password_hash($_POST["Pass"], PASSWORD_DEFAULT);
    $role = $_POST["Role"];

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        header("location: users.php");
        echo "<script>showDanger();</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


// Close the MySQL connection
$conn->close();
?>
