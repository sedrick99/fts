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
    <style>
.success-message {
      background-color: rgb(7, 125, 184);
      color: white;
      padding: 10px 20px;
      text-align: center;
      border-radius: 4px;
      position: fixed;
      top: 5.4rem;
      left: 50%;
      transform: translateX(-50%);
      opacity: 1;
      transition: opacity 0.5s;
    }

    .success-message.fade-out {
      opacity: 0;
    }
    </style>
</head>

<body>
    <nav class="horizontal">
    <header><i class="fas fa-shopping-cart"></i>F.T.S</header>
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
            
    <li class="item "><a href="\fts\php\admin\main-dashboard.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>Dashboard</a></li>
    <li class="item"><a href="#" class="hov itemLink" onclick="toggleSubOptions()"><i class="fas fa-product" id="icon"></i>BUDGET</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="\fts\php\admin\addBudget.php" class="hov sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Budget</a></li>
                    <li class="item"><a href="\fts\php\admin\viewBudget.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Budget</a></li>
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
                    <li class="item"><a href="\fts\php\admin\expense.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Expeses</a></li>
                    <li class="item"><a href="\fts\php\admin\viewExpense.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Expenses</a></li>
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
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions3()"><i class="fas fa-product" id="icon"></i>USERS</a>
                <ul class="sublist" id="subOptions3">
                    <li class="item"><a href="\fts\php\admin\addUsers.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Users</a></li>
                    <li class="item"><a href="\fts\php\admin\users.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Users</a></li>
                </ul> 
                <script>
                   
                   let isSubOptions3Visible = false;
                    function toggleSubOptions3() {
                        const subOptions = document.getElementById("subOptions3");
                        isSubOptions3Visible = !isSubOptions3Visible;
                        subOptions.style.display = isSubOptions3Visible ? 'block' : 'none';
                    }
                </script>
          </li>
          <li class="item"><a href="\fts\php\hospital\hospital-dashboard.php" class="itemLink"><i class="fas fa-hospital" id="icon"></i>HOSPITALS</a></li>
                   <li class="item"><a href="\fts\php\settings.php" class="itemLink"><i class="fas fa-settings" id="icon"></i>SETTINGS</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
        </ul>
    </div> 
    <section>
    <h1 class="titre">proceeds</h1>
    <h3><a href="\fts\php\admin\vewBudget.php"></a></h3>
    <div class="case">
    <div class="main-products">
        <form class="man" method="post">
            <h1>Add New Donation</h1>
            <label for="name">Bussiness Center</label>
            <input type="text" id="name" name="name" placeholder="Enter Donation name" required>
            <label for="amount">ammount Donated</label>
            <input type="number" id="amount" name="amount" placeholder="Enter Ammount" required>
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
$sql = "CREATE TABLE IF NOT EXISTS donations (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date DATETIME NOT NULL
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

// Insert data from form into 'proceeds' table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    
    $sql = "SELECT * FROM donations WHERE name ='$name'";
$result = $conn->query($sql);
    if ($result->num_rows === 0) {

    $sql = "INSERT INTO donations (name, amount, date) VALUES ('$name','$amount','$date')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="success-message" id="success-message">item added successfully!</div>';

        exit();
    }
}else{
    echo '<div class="success-message" id="success-message">already exist!</div>';

}
}

$conn->close();
?>
    </section>
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
</body>
</html>
