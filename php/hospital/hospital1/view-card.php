
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "fts") or die ('connection failed');

// Check if the user is logged in and has a role set in the session
if (!isset($_SESSION['ROLE'])) {
    header("Location: ../login.php");
    exit();
}

// Delete products from database
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM materials WHERE id = '$delete_id'") or die('query failed');
    header('location: viewBudget.php');
}

function renderTable($conn, $tableName, $title)
{
    echo "<div class='main-products'>
            <h1 class='titttle'>$title</h1>
            <div class='butts'>
                <button class='copy' onclick=\"copyTable('$tableName')\">Copy</button>
                <button class='copy' onclick=\"exportToExcel('$tableName')\">Excel</button>
                <button class='copy' onclick=\"printTable('$tableName')\">Print</button>
                <hr>
            </div>
            <table id='$tableName'>
                <tr class='headth'>
                    <th>id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date Added</th>
                </tr>";
    $conn = new mysqli("localhost", "root", "", "fts") or die ('connection failed');

    $sql = "SELECT * FROM $tableName LIMIT 10";
    $result = $conn->query($sql);

    if ($result === false || $result->num_rows == 0) {
        echo '<tr><td colspan="4" class="errorr">No record Found</td></tr>';
    } else {
        while ($row = $result->fetch_assoc()) {
            echo "<tbody>
                    <tr class='row'>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['date']}</td>
                    </tr>
                  </tbody>";
        }
    }

    echo "</table>
          <hr>
          <div class='buts'>
            <button class='neww'><a style='color: white; text-decoration: none;' href='expense/$tableName.php'>Add New</a></button>
            <button class='neww' onclick=\"window.location.href='viewAll.php?table=$tableName'\">View All</button>
          </div>
          </div>";
}

// Close the connection after all tables are rendered
$conn->close();
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
        .neww {
            background-color: blue;
            color: white;
            padding: 6px;
            text-decoration: none;
            border-radius: 7px;
            font-size: 1.25rem;
            margin: 1rem;
        }
        .neww:hover {
            border: 2px solid black;
            background-color: rgb(7, 125, 184);
            transform: scale(1.1);
            transition: .6s;
        }
        .titttle {
            color: rgb(72, 72, 73);
            font-family: verdana;
            margin-left: 40%;
            font-size: 2rem;
        }
        .errorr {
            color: red;
            margin-left: 40%;
        }
    </style>
</head>
<body>
    <nav class="horizontal">
        <header><i class="fas fa-shopping-cart"></i>F.T.S</header>
        <i class="fas fa-user" id="usser" onclick="displayLog()"></i>
        <div class="user-box">
            <p class="name">Username: <span><?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
            <p class="role">Role: <span><?php echo htmlspecialchars($_SESSION['ROLE']); ?></span></p>
            <button class="logout"><a href="/fts/php/logout.php">logout</a></button>
            <button class="cancer" onclick="cancelLog()">X</button>
        </div>
        <script>
            function displayLog() {
                document.querySelector('.user-box').style.display = 'block';
            }
            function cancelLog() {
                document.querySelector('.user-box').style.display = 'none';
            }
        </script>
    </nav>
    <div class="sidebar">
        <ul class="list">
        <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'ceo') {
            echo'
            <li class="item "><a href="\fts\php\admin\main-dashboard.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>ADMIN</a></li>'; } ?>
        
          <li class="item "><a href="\fts\php\hospital\hospital1\kizito.php" class="hov itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>Dashboard</a></li>
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions()"><i class="fas fa-product" id="icon"></i>RECORDS</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="add-card.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Record</a></li>
                    <li class="item"><a href="view-card.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Record</a></li>
                </ul> 
                
                <script>
                    let isSubOptionsVisible = false;

                    function toggleSubOptions() {
                        const subOptions = document.getElementById("subOptions");
                        isSubOptionsVisible = !isSubOptionsVisible;
                        subOptions.style.display = isSubOptionsVisible ? 'block' : 'none';
                    }
                </script>
            </li>
          </li>
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions2()"><i class="fas fa-coins" id="icon"></i>EXPENSES</a>
                <ul class="sublist" id="subOptions2">
                    <li class="item"><a href="expense.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Expeses</a></li>
                    <li class="item"><a href="viewExpense.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Expenses</a></li>
                </ul> 
                <script>
                   
                   let isSubOptions2Visible = false;
                    function toggleSubOptions2() {
                        const subOptions = document.getElementById("subOptions2");
                        isSubOptionsVisible = !isSubOptionsVisible;
                        subOptions.style.display = isSubOptionsVisible ? 'block' : 'none';
                    }
                </script>
          </li>
          <li class="item"><a href="balance.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>Account Balance</a></li>
                   <li class="item"><a href="\fts\php\settings.php" class="itemLink"><i class="fas fa-wrench"></i>SETTINGS</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>

        </ul>
    </div> 

    <section>
        <?php
        // Render each table
        renderTable($conn, 'cards', 'Cards');
        renderTable($conn, 'consultation', 'Consultation');
        renderTable($conn, 'lab', 'Lab');
        renderTable($conn, 'medication', 'Medication');
        renderTable($conn, 'maternity', 'Maternity');
        renderTable($conn, 'delivery', 'Delivery');
        renderTable($conn, 'anc', 'ANC');
        renderTable($conn, 'iwf', 'IWF');
        renderTable($conn, 'bedfee', 'Bedfee');
        renderTable($conn, 'Echography', 'Echography');
        renderTable($conn, 'physiotherapy', 'physiotherapy');
        renderTable($conn, 'minor_surgery', 'Minor-surgery');
        renderTable($conn, 'major_surgery', 'Major-surgery');
        ?>
    </section>
    <script>
        function printTable(tableId) {
            const table = document.getElementById(tableId).outerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print Table</title></head><body>');
            printWindow.document.write(table);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function copyTable(tableId) {
            const table = document.getElementById(tableId);
            const range = document.createRange();
            range.selectNode(table);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            alert('Table copied to clipboard');
        }

        function exportToExcel(tableId) {
            const table = document.getElementById(tableId);
            const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
            XLSX.writeFile(wb, `${tableId}.xlsx`);
            alert("The Excel file has been downloaded. Please open it with Microsoft Excel.");
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
</body>
</html>