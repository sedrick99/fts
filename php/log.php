
<?php
Include "config.php";
include "conect.php";
session_start();


// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    
// Get user input
$user = $_POST['username'];
$pass = $_POST['password'];

// Check the credentials
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        $_SESSION['username'] = $user;
        $_SESSION['ROLE'] = $row['role'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['department'] = $row['department'];
        
        // Redirect to dashboard based on role

        if ($_SESSION['ROLE'] == 'admin') {
        header('location: \fts\php\admin\main-dashboard.php');
    }elseif($_SESSION['department'] == 'St. Therese') {
        header('location: \fts\php\hospital\hospital2\therese.php');
    }elseif($_SESSION['department'] == 'St. Zelie') {
        header('location: \fts\php\hospital\hospital3\zelie.php');
    } elseif($_SESSION['department'] == 'St. kizito') {
        header('location: \fts\php\hospital\hospital1\kizito.php');
    }elseif($_SESSION['department'] == 'Health Center') {
        header('location: \fts\php\hospital\hospital4\healCenter.php');
    }else{
     // Login failed
        echo "no role assigned";
    }
        exit();
    } else {
        $_SESSION['error'] = "Invalid password.";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "No such user found.";
    header("Location: login.php");
    exit();
}
}
$conn->close();
?>
