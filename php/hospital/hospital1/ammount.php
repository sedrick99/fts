<?php
include '../conect.php'; // Your database connection file

$totalSum = 0;

// Array of table names
$tableNames = [
'cards', 'lab', 'bedfees', 'cd4', 'consultation', 'maternity', 'medication', 'delivery', 'anc', 'iwf', 'gynaecology',
'echography', 'physiotherapy', 'minor_surgery', 'major_surgery', 'pbf', 'prchases', 'rates', 'services'

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


?>