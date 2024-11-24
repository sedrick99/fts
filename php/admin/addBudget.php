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
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions()"><i class="fas fa-money-bill" id="icon"></i>BUDGET</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="addBudget.php" class="hov sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Budget</a></li>
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
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions3()"><i class="fas fa-users" id="icon"></i>USERS</a>
                <ul class="sublist" id="subOptions3">
                    <li class="item"><a href="addUsers.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Users</a></li>
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
          <li class="item"><a href="\fts\php\hospital\hospital-dashboard.php" class="itemLink"><i class="fas hospital" id="icon"></i>HOSPITALS</a></li>
                   <li class="item"><a href="\fts\php\settings.php" class="itemLink"><i class="fas fa-wrench"></i>SETTINGS</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
        </ul>
    </div>  
    <section>
      <div class="proceed">
        <h1 class="sal"><a href="budget\salaries.php">SALARIES</a></h1>
        <h1 class="sal"><a href="budget\proceeds.php">PROCEEDS</a></h1>
        <h1 class="sal"><a href="budget\contracts.php">FROM CONTRACTS</a></h1>
        <h1 class="sal"><a href="budget\donations.php">DONATIONS</a></h1>
        <h1 class="sal"><a href="budget\others.php">OTHERS</a></h1>
 

      </div>
    </section>
    <style>
        .proceed{
            width: 90%;
            position: absolute;
            left: 5%;
        }
        .sal{
            border-radius: 18px ;
            background-color:rgb(7, 125, 184);
            box-shadow:  4px 7px rgba(0, 0, 0, 0.2), 0 6px 20px 0 ;
            /* background-color: #52abd4; */
            border: 3px solid white;
            margin: 15px;
            padding: 12px;
            text-align: center;

        }
        .sal a{
        
            
            text-decoration: none;
            color: white;
        }
        .sal:hover{
            transform: scaleX(1.06);
            transition: 1.7s;
            background: #52abd4;
        }
    </style>
</body>
</html>