<?php
Include "config.php";

If ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["admin_user"] = $_POST["admin_user"];
    $_SESSION["admin_pass"] = $_POST["admin_pass"];
}
?>
<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Installation Step 3</title>
</head>
<body>
    <form action="step4.php" method="post">
        <h2>Step 3: Site Settings</h2>
        <input type="text" name="site_name" placeholder="Site Name" required>
        <input type="text" name="site_url" placeholder="Site URL" required>
        <button type="submit">Next</button>
    </form>
</body>
</html>
