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
        <?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'ceo') {
            echo'
            <li class="item "><a href="\fts\php\admin\main-dashboard.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>MAIN DASHBOARD</a></li>'; } ?>
       
          <li class="item "><a href="\fts\php\hospital\hospital1\kizito.php" class="itemLink "><i class="fas fa-tachometer-alt" id="icon"></i>Dashboard</a></li>
          <li class="item"><a href="#" class="hov itemLink" onclick="toggleSubOptions()"><i class="fas fa-product" id="icon"></i>RECORDS</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="add-card.php" class="hov sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Record</a></li>
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
          <li class="item"><a href="balance.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>Account Balance</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>

        </ul>
    </div> 
    <section>
      <div class="proceed">
      <h1 class="sal"><a href="records\cards.php">CARDS</a></h1>
      <h1 class="sal"><a href="records\consultation.php">CONSULTATION</a></h1>
      <h1 class="sal"><a href="records\lab.php">LABORATORY</a></h1>
      <h1 class="sal"><a href="records\medication.php">MEDICATION</h1>
      <h1 class="sal"><a href="records\delivery.php">DELIVERY</a></h1>
      <h1 class="sal"><a href="records\anc.php">ANC</a></h1>
      <h1 class="sal"><a href="records\iwf.php">IWF</a></h1>
      <h1 class="sal"><a href="records\bedfee.php">BED FEE</a></h1>
      <h1 class="sal"><a href="records\echo.php">ECHOGRAPHY</a></h1>
      <h1 class="sal"><a href="records\physio.php">PHYSIOTHERAPY</h1>
      <h1 class="sal"><a href="records\surgery.php">SURGERY</a></h1>
      <h1 class="sal"><a href="records\gynae.php">GYNAECOLOGY</a></h1>
      <h1 class="sal"><a href="records\dentistry.php">DENTISTRY</a></h1>
<<<<<<< HEAD
      <h1 class="sal"><a href="records\cd4.php">X-RAY</a></h1>
      <h1 class="sal"><a href="records\.dressing.php">DRESSING</a></h1>
=======
      <h1 class="sal"><a href="records\xray.php">X-RAY</a></h1>
      <h1 class="sal"><a href="records\dressing .php">DRESSING</a></h1>
>>>>>>> 2ffa24dc7c3031ed30438ee4f6317d001685fdb5
     </div>
    </section>

</body>
</html>