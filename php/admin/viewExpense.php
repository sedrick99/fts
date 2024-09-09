<?php
session_start();
include '../conect.php';

// Check if the user is logged in and has a role set in the session
if(!isset($_SESSION['ROLE'] )) {
    header("Location: ../login.php");
    exit();
}
     //delete products from database
     if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM materials WHERE id = '$delete_id'") or die('query failed');
        
           header('location: viewBudget.php'); 
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
      .neww{
    background-color: blue;
    color: white;
    padding: 6px;
    margin-left: 40%;
    text-decoration: none;
    border-radius: 7px;
    text-justify: auto;
    font-size: 1.25rem;
    
  }
  .neww:hover{
    border: 2px solid black;
}
.titttle{
    color: rgb(72, 72, 73);
    font-family: verdana;
    margin-left: 40%;
    font-size: 2rem;
}
.errorr{
    color: red;
    margin-left: 40%;
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
          <li class="item hov"><a href="#" class="hov itemLink" onclick="toggleSubOptions()"><i class="fas fa-product" id="icon"></i>BUDGET</a>
                <ul class="sublist" id="subOptions">
                    <li class="item"><a href="addBudget.php" class="sublink"><i class="fas fa-plus-circle" id="icon"></i>Add Budget</a></li>
                    <li class="item"><a href="viewBudget.php" class="hov sublink"><i class="fas fa-eye" id="icon"></i>View Budget</a></li>
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
          <li class="item"><a href="#" class="itemLink" onclick="toggleSubOptions3()"><i class="fas fa-product" id="icon"></i>USERS</a>
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
          <li class="item"><a href="\fts\php\hospital\hospital-dashboard.php" class="itemLink"><i class="fas fa-hospital" id="icon"></i>HOSPITALS</a></li>
          <li class="item"><a href="\fts\php\logout.php" class="itemLink"><i class="fas fa-sign-out-alt" id="icon"></i>LOg Out</a></li>
        </ul>
    </div> 
    <section>
    <div class="head-pro">
            <h4 class="haed">Budget</h4>
            <button class="add"><a href="addBudget.php" style="color: white;">Add New Budget</a></button>
            </div>
            <div class="main-products">
            <h1 class="titttle">Expenditure</h1>
            <br>
            <div class="butts">
                <button class="copy" onclick="copyTable('table1')">Copy</button>
                <button  class="copy" onclick="exportToExcel('table1')">Excel</button>
                <button class="copy"onclick="printTable('table1')">Print</button>
                <br>
                <br>
                <hr>
            </div>
            <table id="table1">
                <tr class="headth">
                    <th>id</th>
                    <th>contry</th>
                    <th>Amount</th>
                    <th>Date Added</th>
                    <th>Action</th>

                </tr>
            
            <br>

    <?php 
                    $sql = "SELECT * FROM expenditure";
                    $result = $conn->query($sql);
                    if ($result === true) {
                        // If the table does not exist or any other error, show "No record found"
                        echo '<h1 class="errorr">No record Found</h1>';
                    } else {
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['amount'].'</td>
                                    <td>'.$row['date'].'</td>
                                    
                                    
                            </tbody>
                            ';
                        }
                            }else{
                             echo '<h1 class="errorr">No record Found</h1>';
                            }
                        }
                    
                $conn->close();
                
                
     ?>
            </table>
            <hr>
            <br>
            <a class="neww" href="budget\expenditure.php"><i class="fas fa-plus"></i>Add New</a>
       
            </div>
          <div class="main-products">
            <h1 class="titttle">materials</h1>
            <br>
            <!-- <div class="search">
                <button type="submit" id="search" class="search-btn"><i class="fas fa-search"></i></button>
                <input type="text" placeholder="search" class="text-area">
            </div> -->
            <div class="butts">
            <button class="copy" onclick="copyTable('table2')">Copy</button>
            <button  class="copy" onclick="exportToExcel('table2')">Excel</button>
            <button class="copy"onclick="printTable('table2')">Print</button>
                <br>
                <br>
                <hr>
            </div>
            <table id="table2">
                                 <tr class="headth">
                                     <th>id</th>
                                     <th>Raw Material</th>
                                     <th>Amount</th>
                                     <th>Date Added</th>
                                     <th>Action</th>

                                   </tr>
            
            <br>

    <?php 
                 include '../conect.php';
                    $sql = "SELECT * FROM materials";
                    $result = $conn->query($sql);
                    if ($result === false) {
                        // If the table does not exist or any other error, show "No record found"
                        echo '<h1 class="errorr">No record Found</h1>';
                    } else {
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['amount'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <button id="edit"><a href="viewBudget.php?edit='.$row['id'].'" class="edit"><i class="fas fa-edit" style="color: white;" aria-hidden="true"></i></a></button>
                                    <button id="del"><a href="viewBudget.php?delete=<?php echo '.$row['id'].'; ?>" class="delete" onclick="return confirm(\'Do you really want to delete this record?\');"><i class="fas fa-trash" style="color: white;" aria-hidden="true"></i></a></button>
                                    </td>
                                    </tr>
                                    
                            </tbody>';
                        }
                            }else{
                             echo '<h1 class="errorr">No record Found</h1>';
                            }
                        }
                    
                $conn->close();
                
                
   ?>

            </table>
            <hr>
            <br>
            <a class="neww" href="budget\materials.php"><i class="fas fa-plus"></i>Add New</a>
          </div>
          <div class="main-products">
          <h1 class="titttle">Transport Fare</h1>
            <div class="butts">
            <button class="copy" onclick="copyTable('table3')">Copy</button>
            <button  class="copy" onclick="exportToExcel('table3')">Excel</button>
            <button class="copy"onclick="printTable('table3')">Print</button>
                <br>
                <br>
                <hr>
            </div>
            
            <br>
         <?php 
                    include '../conect.php';
                    $sql = "SELECT * FROM contracts";
                    $result = $conn->query($sql);
                    if ($result === false) {
                        // If the table does not exist or any other error, show "No record found"
                        echo '<h1 class="errorr">No record Found</h1>';
                    } else {
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <table id="table3">
             
                                 <tr class="headth">
                                     <th>id</th>
                                     <th>Contract Name</th>
                                     <th>Amount</th>
                                     <th>Date Added</th>
                                     <th>Action</th>

                                 </tr>
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['amount'].'</td>
                                    <td>'.$row['date'].'</td>
                                    
                                    
                            </tbody>
                            </table>';
                        }
                            }else{
                             echo '<h1 class="errorr">No record Found</h1>';
                            }
                        }
                $conn->close();
    ?>
            <hr>
            <br>
            <a class="neww" href="budget\contracts.php"><i class="fas fa-plus"></i>Add New</a>
          </div>
          <div class="main-products">
          <h1 class="titttle">Donations</h1>
            <div class="butts">
            <button class="copy" onclick="copyTable('table4')">Copy</button>
            <button  class="copy" onclick="exportToExcel('table4')">Excel</button>
            <button class="copy"onclick="printTable('table4')">Print</button>
                <br>
                <br>
                <hr>
            </div>
            
            <br>
         <?php 
                 include '../conect.php';
                    $sql = "SELECT * FROM donations";
                    $result = $conn->query($sql);
                    if ($result === false) {
                        // If the table does not exist or any other error, show "No record found"
                        echo '<h1 class="errorr">No record Found</h1>';
                    } else {
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <table id="table4">
             
                                 <tr class="headth">
                                     <th>id</th>
                                     <th>Donation Name</th>
                                     <th>Amount</th>
                                     <th>Date Added</th>
                                     <th>Action</th>

                                 </tr>
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['amount'].'</td>
                                    <td>'.$row['date'].'</td>
                                    
                                    
                            </tbody>
                            </table>';
                        }
                            }else{
                             echo '<h1 class="errorr">No record Found</h1>';
                        }
                    }
                    
                $conn->close();
    ?>
            <hr>
            <br>
            <a class="neww" href="budget\donations.php"><i class="fas fa-plus"></i>Add New</a>
          </div>

          <div class="main-products">
          <h1 class="titttle">Others</h1>
            <div class="butts">
            <button class="copy" onclick="copyTable('table5')">Copy</button>
            <button  class="copy" onclick="exportToExcel('table5')">Excel</button>
            <button class="copy"onclick="printTable('table5')">Print</button>
                <br>
                <br>
                <hr>
            </div>
            
            <br>
         <?php 
                 include '../conect.php';
                    $sql = "SELECT * FROM others";
                    $result = $conn->query($sql);
                    $sql = "SELECT * FROM others";
                    $result = $conn->query($sql);

// Check if the query was successful
                    if ($result === false) {
                        // If the table does not exist or any other error, show "No record found"
                        echo '<h1 class="errorr">No record Found</h1>';
                    } else {
                    
                    if ($result->num_rows == 0) {
                        echo '<h1 class="errorr">No record Found</h1>';
                    }else{
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <table id="table5">
             
                                 <tr class="headth">
                                     <th>id</th>
                                     <th>Other Budget</th>
                                     <th>Amount</th>
                                     <th>Date Added</th>
                                     <th>Action</th>

                                 </tr>
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['amount'].'</td>
                                    <td>'.$row['date'].'</td>
                                    
                                    
                            </tbody>
                            </table>';
                        }
                            }
                             
                        }
                $conn->close();
    ?>
            <hr>
            <br>
            <a class="neww" href="budget\others.php"><i class="fas fa-plus"></i>Add New</a>
          </div>
          

    </section>
    <section class="update">

<?php  
 if(isset($_GET['edit'])){
     $edit_id = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM materials WHERE id = '$edit_id'") or die('query failed');
    if(mysqli_num_rows($edit_query)){
     while($fetch_edit = mysqli_fetch_assoc($edit_query)){
 ?>
 <form action="edit.php"method="post">
 <input type="hidden" name="up_id" value="<?php echo $fetch_edit['id'] ?>">
 <input type="text" name="name" value="<?php echo $fetch_edit['name'] ?>">
 <input type="number" name="amount" value="<?php echo $fetch_edit['amount'] ?>">
 <input type="DATETIME" name="date" value="<?php echo $fetch_edit['date'] ?>">
 <input type="submit" mame="update" value="update" class="edit ">
 <input type="reset" mame="cancel" value="cancel" id="close_form" class="btn" onclick="canceledit()">
 </form>
 <?php
    }
  }
        echo "<script>document.querySelector('.update').style.display='block'</script>";
 }
      


   ?>
   <script>
    function canceledit(){
    document.querySelector('.update').style.display = 'none';
}
   </script>
<?php
          if(isset($_GET['update'])){
            $edit_id = $_GET['edit'];
             //updatting product after editinh
             $update_id = $_POST['up_id'];
             $name = $_POST['name'];
             $amt = $_POST['ammount'];
             $date = $_POST['date'];
             $update_query = mysqli_query($conn, "UPDATE materials SET name='$name', amount='$amt', date='$date' WHERE id='$update_id' ") or die('query failed');
      
     if($update_query !== TRUE){;
         echo "something went wrong";
      }
    }
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
