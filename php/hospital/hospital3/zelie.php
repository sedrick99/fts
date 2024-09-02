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
    <header>ST. ZELIE & LOUIS </header>
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
        <div class="cards">
            <div class="card">
                    <div class="box">
                        <i class="fas fa-money-bill" id="icon1"></i>
                    </div>
                    <div class="box2">
                        <h3 >Overall Budget</h3>
                        <h1>00</h1>
                    </div>
            </div>
            <div class="card">
                <div class="box">
                    <i class="fas fa-qrcode" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Net Budget</h3>
                    <h1>00</h1>
                </div>
            </div>
            <div class="card">
                <div class="box">
                    <i class="fas fa-qrcode" id="icon1"></i>
                </div>
                <div class="box2">
                    <h3 >Expenses</h3>
                    <h1>00</h1>
                </div>
        </div>
        <div class="card">
            <div class="box">
                <i class="fas fa-users" id="icon1"></i>
            </div>
            <div class="box2">
                <h3 >Users</h3>
                <h1>00</h1>
            </div>
    </div>
    <div class="card">
        <div class="box">
            <i class="fas fa-qrcode" id="icon1"></i>
        </div>
        <div class="box2">
            <h3 >Daily Budget</h3>
            <h1>00</h1>
        </div>
</div>
<div class="card">
    <div class="box">
        <i class="fas fa-list" id="icon1"></i>
    </div>
    <div class="box2">
        <h3 >Items</h3>
        <h1>00</h1>
    </div>
</div>
    </div>
        <div class="content2">
            <div class="recent">
                <canvas id="myChart"></canvas>
                </div>
            <div class="recents">
                <canvas id="myLineChart"></canvas>
            </div>
        </div>

  <script>
    // Sample data
    var data = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June'],
      datasets: [{
        label: 'Sales',
        data: [1200, 1700, 800, 1500, 2000, 1300],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };

    // Get the canvas element
    var ctx = document.getElementById('myChart').getContext('2d');

    // Create the chart
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
fetch('data.php')
.then(response => response.json())
.then(data => {
  const weeks = data.map(sale => sale.week_number);
  const amounts = data.map(sale => sale.total_amount);

  const ctx = document.getElementById('salesChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: weeks,
      datasets: [{
        label: 'Sales Amount',
        data: amounts,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
})
.catch(error => console.error('Error:', error));
});
          </script>
          <script>
                // Get the canvas element
                var ctx = document.getElementById('myLineChart').getContext('2d');
            
                // Define your data
                var data = {
                    labels: ['Label1', 'Label2', 'Label3'],
                    datasets: [{
                        label: 'My Line Chart',
                        data: [3, 6, 4],
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 2,
                        fill: false
                    }]
                };
            
                // Configure the options
                var options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'category',
                            labels: data.labels
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                };
            
                // Create the line chart
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
            
            </script> 
            
                        
    </section>
</body>
</html>