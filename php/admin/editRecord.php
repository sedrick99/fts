<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fts");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the table name and ID from the query string
$tableName = $_GET['table'];
$id = $_GET['id'];

// Validate the table name to avoid SQL injection
$validTables = ['salaries', 'proceeds', 'others'];
if (!in_array($tableName, $validTables)) {
    echo "Invalid table specified.";
    exit;
}

// Query to get the record
$sql = "SELECT * FROM $tableName WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Record not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="\fts\css\main.css">
    <link rel="stylesheet" href="\fts\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <script src="\fts\js\jquery-3.7.1.min.js"></script>
    <script src="\fts\js\chart.umd.js"></script>
    <style>
      
    </style>
</head>
<body>

<div class="main-products">
<form action="updateRecord.php" method="POST">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($tableName); ?>"> <!-- Hidden input for table name -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> <!-- Hidden input for ID -->
            
            <?php foreach ($row as $column => $value): ?>
                <?php if ($column !== 'id'): ?> <!-- Exclude the ID field from being editable -->
                    <label for="<?php echo $column; ?>"><?php echo ucfirst($column); ?>:</label>
                    <input type="text" name="<?php echo $column; ?>" value="<?php echo htmlspecialchars($value); ?>" required><br>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit">Save Changes</button>
        </form>
</div>
    </div>
</div>

</body>
</html>