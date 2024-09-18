<?php
include 'conect.php'; // Your database connection file

$totalSum = 0;

// Array of table names
$tableNames = [
    'table1', 'table2', 'table3', 'table4', 'table5',
    'table6', 'table7', 'table8', 'table9', 'table10',

];

foreach ($tableNames as $tableName) {
    // Check if the table exists
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $tableExists = $conn->query($checkTableQuery);

    if ($tableExists && $tableExists->num_rows > 0) {
        // Table exists, perform the SUM query
        $query = "SELECT SUM(amount) AS total FROM $tableName";
        $result = $conn->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            $totalSum += $row['total'];
        }
    } else {
        // Table does not exist, consider its sum as 0
        $totalSum += 0;
    }
}

echo "The total sum of all amounts is: $totalSum";
?>