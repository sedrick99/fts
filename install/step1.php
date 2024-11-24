<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Installation Step 1</title>
</head>
<body>
    <form action="step2.php" method="post">
        <h2>Step 1: Database Details</h2>
        <input type="text" name="db_host" placeholder="Db_Host" required>
        <input type="text" name="db_user" placeholder="Database_User" required>
        <input type="password" name="db_pass" placeholder="Database_Password" required>
        <input type="text" name="db_name" placeholder="Database_Name" required>
        <button type=”submit”>Next</button>
    </form>
</body>
</html>
