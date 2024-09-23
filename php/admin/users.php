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
                   <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions()"><i class="fas fa-money-bill" id="icon"></i>BUDGET</a>

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
          <li class="item"><a href="#" class="hov itemLink" onclick="toggleSubOptions3()"><i class="fas fa-product" id="icon"></i>USERS</a>
                <ul class="sublist" id="subOptions3">
                    <li class="item"><a href="addUsers.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Users</a></li>
                    <li class="item"><a href="users.php" class="hov sublink"><i class="fas fa-eye" id="icon"></i>View Users</a></li>
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
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
        </ul>
    </div> 
    <section>
    <div class="head-pro">
            <h4 class="haed">MANAGE USERS</h4>
            <button class="add"><a href="addUsers.php" style="color: white;">Add New Member</a></button>
            </div>
          <div class="main-products">
            <div class="search">
                <button type="submit" id="search" class="search-btn"><i class="fas fa-search"></i></button>
                <input type="text" placeholder="search" class="text-area">
            </div>
            <div class="butts">
                <button class="copy">Copy</button>
                <button class="copy">CSV</button>
                <button class="copy">Excel</button>
                <button class="copy">Print</button>
                <br>
                <br>
                <hr>
            </div>
            
            <br>
            
            <table>
                <tr class="headth">
                    <th>id</th>
                    <th>Users</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>

    <?php 
                 include '../conect.php';
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['role'].'</td>
                                    <td>'.$row['department'].'</td>';
                                    echo "<td>
                                    <button id='edit' class='edit-button' data-id='{$row['id']}'><i class='fas fa-edit' style='color: white;' aria-hidden='true'></i></button>
                                    <button id='del' class='delete-button' data-id='{$row['id']}'><i class='fas fa-trash' style='color: white;' aria-hidden='true'></button>
                                  </td>";
                                    
                                //     <td>
                                //     <button id="edit"><a href="users.php?edit='.$row['id'].'" class="edit"><i class="fas fa-edit" style="color: white;" aria-hidden="true"></i></a></button>
                                //     <button id="edit"><a href="users.php?message='.$row['id'].'" class="edit"><i class="fa fa-comment" style="color: white;" aria-hidden="true"></i></a></button>
                                //     <button id="del"><a href="users.php?delete='.$row['id'].'" class="delete" onclick="return confirm("Do you really want to delete this product");"><i class="fa fa-trash" style="color: white;" aria-hidden="true"></a></button>
                                // </td>
                                echo'
                                    </tr>
                            </tbody>';
                        }
                            }else{
                             echo 'connection failed';
                            }
                    
                $conn->close();
                
                
                  ?>
            </table>
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


    </section>
</body>
</html>
