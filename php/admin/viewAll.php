<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>
    <link rel="stylesheet" href="\fts\css\main.css">
    <link rel="stylesheet" href="\fts\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <script src="\fts\js\jquery-3.7.1.min.js"></script>
    <script src="\fts\js\chart.umd.js"></script>
    <style>
        /* Basic styles for the modal */
    .cover{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100vh;
        margin: 0;
        padding: 0;
        background: rgb(150, 176, 231);

}
table{
    border: none;
}
th{
    border: none;
    border-bottom: 1px solid;
}
td{
    border: none;
    border-bottom: 1px solid;
}
    </style>
</head>
<body>
<div class="cover">
    <div class="main-products">
<div class="butts">
    <button class="copy" onclick="copyTable('table1')">Copy</button>
    <button  class="copy" onclick="exportToExcel('table1')">Excel</button>
    <button class="copy"onclick="printTable('table1')">Print</button>
    <br>
    <br>
    <hr>
</div>
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fts");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the table name from the URL parameter
$tableName = isset($_GET['table']) ? $_GET['table'] : 'others'; // Default to 'others'

// Validate the table name to avoid SQL injection
$validTables = ['salaries', 'proceeds', 'donations','contracts', 'others', 'expenditure', 'materials', 'allowance', 'transport',
'plough', 'creditors', 'servicesb', 'c_building', 'servicea', 'taxes', 'lab', 'other_exp', 'cards',
 'depreciation'];
if (!in_array($tableName, $validTables)) {
    echo "<h2>Invalid table specified.</h2>";
    exit;
}

// Query to select all records from the specified table
$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "<h2>Error executing query: " . $conn->error . "</h2>";
    exit;
}

// Display the records
echo "<h2 class='titttle'>All Records from $tableName</h2>";
echo "<table border='1'>";

// Fetch and display the column names dynamically
$fields = $result->fetch_fields();
echo "<tr>";
foreach ($fields as $field) {
    echo "<th>{$field->name}</th>";
}
echo "<th>Action</th>"; // Add Action column
echo "</tr>";

// Display each row of data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='{$row['id']}'>";
        foreach ($fields as $field) {
            echo "<td>{$row[$field->name]}</td>";
        }
        echo "<td>
                <button id='edit' class='edit-button' data-id='{$row['id']}'><i class='fas fa-edit' style='color: white;' aria-hidden='true'></i></button>
                <button id='del' class='delete-button' data-id='{$row['id']}'><i class='fas fa-trash' style='color: white;' aria-hidden='true'></button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='" . (count($fields) + 1) . "'>No records found.</td></tr>";
}

echo "</table>";
$conn->close();
?>
    </div>
    <a href="viewExpense.php" class="neww">Back</a>
</div>

<script>
    // Open edit modal and redirect to edit page
    document.querySelectorAll('.edit-button').forEach(button => {
        button.onclick = function() {
            const id = this.getAttribute('data-id');
            const table = '<?php echo $tableName; ?>'; // Get the current table name
            window.location.href = `editRecord.php?table=${table}&id=${id}`;
        };
    });

    // Handle delete button click
    document.querySelectorAll('.delete-button').forEach(button => {
        button.onclick = function() {
            const id = this.getAttribute('data-id');
            const table = '<?php echo $tableName; ?>'; // Get the current table name
            if (confirm('Are you sure you want to delete this record?')) {
                window.location.href = 'deleteRecord.php?table=' + table + '&id=' + id; // Redirect to delete
            }
        };
    });
</script>

</body>
</html>