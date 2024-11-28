<?php
session_start();

// Check if the user is logged in and has a role set in the session
if(!isset($_SESSION['ROLE'] )) {
    header("Location: ../login.php");
    exit();
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
</head>

<body>
    <nav class="horizontal">
    <header>ST THERESE MEDICAL CENTER</header>
        <i class="fas fa-user" id="usser"  onclick="displayLog()"></i>

    <div class="user-box">
        
           <p class="name">Username: <span><?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
    <p class="role">Role: <span><?php echo htmlspecialchars($_SESSION['ROLE']); ?></span></p>
    <button class="logout"><a href="/fts/php/logout.php">logout</a></button>
    <button class="cancer" onclick="cancelLog()">X</button>
    </div>
        <script>
            function displayLog(){
                document.querySelector('.user-box').style.display = 'block';
            }  
            function cancelLog(){
                document.querySelector('.user-box').style.display = 'none';
            } 
        </script>
    </nav>
    <div class="sidebar">
        <ul class="list">
        <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'ceo') {
            echo'
            <li class="item "><a href="\fts\php\admin\main-dashboard.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>MAIN DASHBOARD</a></li>'; } ?>
          <li class="item "><a href="\fts\php\hospital\hospital1\kizito.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>Dashboard</a></li>
          <li class="item"><a href="#" class="hov itemLink" onclick="toggleSubOptions()"><i class="fas fa-product" id="icon"></i>RECORDS</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="\fts\php\hospital\hospital1\add-card.php" class="hov sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Record</a></li>
                    <li class="item"><a href="\fts\php\hospital\hospital1\view-card.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Record</a></li>
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
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions2()"><i class="fas fa-product" id="icon"></i>EXPENSES</a>
                <ul class="sublist" id="subOptions2">
                    <li class="item"><a href="\fts\php\hospital\hospital1\expense.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Expeses</a></li>
                    <li class="item"><a href="\fts\php\hospital\hospital1\viewExpense.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Expenses</a></li>
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
          <li class="item"><a href="\fts\php\hospital\hospital1\balance.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>Account Balance</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>

        </ul>
    </div> 
  <section>
    <h3><a href="\fts\php\hospital\hospital1\vew-card.php"></a></h3>
    <div class="case">
    <div class="main-products">
        <form class="man" method="post">
            <h1>Add New Cardiology</h1>
            <label for="name">Paitient's Name</label>
            <input type="text" id="name" name="name" placeholder="Enter customer name" required>
            <label for="amount">Cardiology price</label>
            <input type="number" id="amount" name="amount" placeholder="Enter card price" required>
            <label for="date">Date</label>
            <input type="datetime-local" id="date" name="date" required>
            <button type="submit" name="add">Add</button>

            <script>
        window.onload = function() {
            var error = "<?php echo $error; ?>";
            if (error) {
                document.getElementById('error-message').textContent = error;
                document.getElementById('error-message').style.display = 'block';
            }
        }
    </script>

        </form>

    </div>
    </div>
    


    <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fts") or die ('connection failed');
// Create the 'proceeds' table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS cd4 (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date DATETIME NOT NULL,
    hospital_id INT(10) NOT NULL,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id)
)";

if($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

// Insert data from form into 'proceeds' table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $hospital_id = 2;
    
    $sql = "SELECT * FROM cd4 WHERE name ='$name'";
$result = $conn->query($sql);
    if ($result->num_rows === 0) {

    $sql = "INSERT INTO cd4 (name, amount, date, hospital_id) VALUES ('$name','$amount','$date', '$hospital_id')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="success-message" id="success-message">record added successfully!</div>';

        exit();
    }
}else{

    $sql = "UPDATE cd4 SET amount = '$amount' WHERE name = '$name'";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="success-message" id="success-message">Name Already exists! Amount updated.</div>';
    }
}
}

$conn->close();
?>
  <script>
    // Show the success message
    const successMessage = document.getElementById('success-message');
    successMessage.style.display = 'block';

    // Fade out the success message after 3 seconds
    setTimeout(() => {
      successMessage.classList.add('fade-out');
      setTimeout(() => {
        successMessage.style.display = 'none';
      }, 500); // Fade duration
    }, 3000); // Display duration
  </script>
  </section>

</body>
</html>