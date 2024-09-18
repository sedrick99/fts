<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fts");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the table and ID keys are set
if (!isset($_POST['table']) || !isset($_POST['id'])) {
    die("Table name or ID is missing.");
}

$id = $_POST['id'];
$tableName = $_POST['table'];

// Validate the table name to avoid SQL injection
$validTables = ['users', 'salaries', 'proceeds', 'donations','contracts', 'others', 'expenditure', 'materials', 'allowance', 'transport',
'plough', 'creditors', 'servicesb', 'c_building', 'servicea', 'taxes', 'lab', 'other_exp', 'cards',
 'depreciation'];
if (!in_array($tableName, $validTables)) {
    die("Invalid table specified.");
}

// Prepare the update query dynamically
$setClause = [];
foreach ($_POST as $key => $value) {
    if ($key != 'id' && $key != 'table') {
        // Escape the value to prevent SQL injection
        $value = $conn->real_escape_string($value);
        $setClause[] = "$key='$value'";
    }
}
$setClauseString = implode(', ', $setClause);

// Check if the set clause is empty
if (empty($setClauseString)) {
    die("No data to update.");
}

$sql = "UPDATE $tableName SET $setClauseString WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: viewAll.php?table=$tableName"); // Redirect back after update
    echo '<div class="success-message" id="success-message">Product added successfully!</div>';
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>