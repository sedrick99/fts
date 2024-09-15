<?php
session_start();
include 'conect.php'; // Your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
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
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $update_query = "UPDATE users SET username = ?, password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $new_username, $new_password, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['username'] = $new_username;
        echo "Username and password updated successfully!";
    } else {
        echo "Error updating information.";
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
    </style>
</head>
<body>
    <div class="container">
        <h1>User Settings</h1>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        <p><strong>Tasks:</strong> <?php echo htmlspecialchars($user['tasks']); ?></p>
        
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>