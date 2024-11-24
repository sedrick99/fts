<?php
Include "config.php";

If ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["db_host"] = $_POST["db_host"];
    $_SESSION["db_user"] = $_POST["db_user"];
    $_SESSION["db_pass"] = $_POST["db_pass"];
    $_SESSION["db_name"] = $_POST["db_name"];
}
?>
<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Installation Step 2</title>
</head>
<body>
    <form action="step3.php" method="post">
        <h2>Step 2: Admin Account</h2>
        <input type="text" name="admin_user" placeholder="Admin Username" required>
        <input type="password" name="admin_pass" placeholder="Admin Password" required>
        <button type="submit">Next</button>
    </form>
</body>
</html>
