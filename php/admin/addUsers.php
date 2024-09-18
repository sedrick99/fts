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
        .sava{
            padding: 5px;
            border-radius: 1rem;
            margin: 1rem;
            background: blue;
            font-size: 2rem;
            width: 20%;
            color: white;

        }
        .sava:hover{
             transform: scale(0.93);
             transition: .7s;
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
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions()"><i class="fas fa-product" id="icon"></i>BUDGET</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="addBudget.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Budget</a></li>
                    <li class="item"><a href="viewBudget.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Budget</a></li>
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
          <li class="item"><a href="#" class="hov itemLink" onclick="toggleSubOptions3()"><i class="fas fa-product" id="icon"></i>USERS</a>
                <ul class="sublist" id="subOptions3">
                    <li class="item"><a href="addUsers.php" class="hov sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Users</a></li>
                    <li class="item"><a href="users.php" class="sublink"><i class="fas fa-eye" id="icon"></i>View Users</a></li>
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
          <li class="item"><a href="\fts\php\settings.php" class="itemLink"><i class="fas fa-wrench"></i>SETTINGS</a></li>
                   <li class="item"><a href="\fts\php\settings.php" class="itemLink"><i class="fas fa-wrench"></i>SETTINGS</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
        </ul>
    </div> 
    <section>
        <br>
    <div class="head-pro">
        <button class="neww"><a href="users.php" style="color: white; text-decoration: none;">view all users</a></button>
    </div>
    <div class="main-products">
        <h1 class="titttle">Add User</h1>
        <form action="add-user.php" method="POST" id="editForm" style="display: grid;">
            <label >Name:</label>
            <input type="text" id="name" name="Name" placeholder="enter new members name" required>
            <label >password:</label>
            <input type="text" id="pass" name="Pass" placeholder="assign passsword to user" required>
            <label >Role:</label>
            <select name="Role" style="height: 3rem;">
                <option value="admin">admin</option>
                <option value="matron">matron</option>
                <option value="pharmacist">pharmacist</option>
                <option value="accountant">accountant</option>
            </select>
            <label >department</label>
            <select name="dep" id="hospitals">
            <?php
            $conn = new mysqli("localhost", "root", "", "fts") or die ('connection failed');
            // SQL query to select hospital names
            $sql = "SELECT hospital_name FROM hospitals"; // Assuming hospital_id is a unique identifier
            $result = $conn->query($sql);

            // Check if there are results and fetch them
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['hospital_name']) . '">' . htmlspecialchars($row['hospital_name']) . '</option>';
                }
            } else {
                echo '<option value="">No hospitals found</option>';
            }

            // Close the connection
            $conn->close();
            ?>
        </select>
            <button type="submit" name="submit" class="neww" >Save</button>
        </form>
    </div>
   </section>
</body>
</html>
