<?php
session_start();
include 'conect.php'; // Your database connection file

// Check if the user is logged in
if (!isset($_SESSION['ROLE'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission to update username and password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['username'];
    $old_password = $_POST['old_pass'];
    $new_password = $_POST['new_pass'];

    // Verify the old password
    if (password_verify($old_password, $user['password'])) {
        $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_query = "UPDATE users SET username = ?, password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssi", $new_username, $hashed_new_password, $user_id);

        if ($update_stmt->execute()) {
            $_SESSION['username'] = $new_username;
            echo '<div class="success-message" id="success-message">Updated successfully!</div>';
        } else {
            echo '<div class="error-message" id="error-message">Error updating information.</div>';
        }
    } else {
        echo '<div class="error-message" id="error-message">Wrong password!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 500px; margin: 0 auto; padding: 20px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 5px 0; }
        button { padding: 10px 15px; background-color: #007BFF; color: #fff; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .success-message, .error-message { margin-top: 10px; padding: 10px; color: #fff; display: none; }
        .success-message { background-color: #28a745; }
        .error-message { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Settings</h1>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($user['department']); ?></p>
        
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="old_pass">Old Password:</label>
            <input type="password" id="old_pass" name="old_pass" required>

            <label for="new_pass">New Password:</label>
            <input type="password" id="new_pass" name="new_pass" required>

            <button type="submit">Update</button>
            <button><a href="\fts\php\admin\main-dashboard.php>Back</a></button>
        </form>
    </div>
    <script>
    // Show the success or error message
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');
    if (successMessage) {
        successMessage.style.display = 'block';
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 3000);
    }
    if (errorMessage) {
        errorMessage.style.display = 'block';
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 3000);
    }
    </script>
</body>
</html>