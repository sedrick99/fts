<?php
session_start();
 include '../conect.php';
// Check if the user is logged in and has a role set in the session
if(!isset($_SESSION['ROLE'])) {
    header("Location: \fts\php\login.php");
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hospital-Dashboard</title>
    <link rel="stylesheet" href="\fts\css\main.css">
    <link rel="stylesheet" href="\fts\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <script src="\fts\js\jquery-3.7.1.min.js"></script>
    <script src="\fts\chart.umd.js"></script>
    <style>
        .sublist,
        .sublist2{
            display: none;
        }
    </style>
</head>
<body>
    <nav class="horizontal">
        <header><i class="fas fa-shopping-cart"></i>HOSPITAL-DASHBOARD</header>
            <i class="fas fa-user" id="usser"  onclick="displayLog()"></i>
    
        <div class="user-box">
            <p>username<span></p>
            <p>role</span></p>
                <button type="submit" class="logout-btn">Log Out</button>
                <button onclick="cancelLog()" class="cancel">X</button>
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
            <li class="item "><a href="\fts\php\hospital\hospital-dashboard.php" class="hov itemLink "><i class="fas fa-hospital" id="icon"></i>DASHBOARD</a></li> 
            <li class="item"><a href="hospital1\kizito.php" class="itemLink"><i class="fas fa-users" id="icon"></i>ST.KIZITO</a></li>
            <li class="item"><a href="#" class="itemLink"><i class="fas fa-users" id="icon"></i>ST. THERESE</a></li>
            <li class="item"><a href="#" class="itemLink"><i class="fas fa-users" id="icon"></i>STs ZELIE & LOUIS</a></li>
            <li class="item"><a href="#" class="itemLink"><i class="fas fa-users" id="icon"></i>hospital4</a></li>
            <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>

        </ul>
    </div> 
    <section>
        <div class="cards">
            <div class="card">
                <div class="box">
                    <i class="fas fa-qrcode" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Total Stock</h3>
                    <h1>00</h1>
                </div>
            </div>
            <div class="card">
                <div class="box">
                    <i class="fas fa-qrcode" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Daily Sales</h3>
                    <h1>00</h1>
                </div>
            </div>
            <div class="card">
                <div class="box">
                    <i class="fas fa-qrcode" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Weekly Sales</h3>
                    <h1>00</h1>
                </div>
            </div>
            <div class="card">
                <div class="box">
                    <i class="fas fa-qrcode" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Low Stock</h3>
                    <h1>00</h1>
                </div>
            </div>
            <div class="card">
                <div class="box">
                    <i class="fas fa-user" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Suppliers</h3>
                    <h1>00</h1>
                </div>
            </div>  

        </div>
    </section>
</body>
</html>