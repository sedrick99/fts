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
        mysqli_query($conn, "DELETE FROM proceeds WHERE id = '$delete_id'") or die('query failed');
        
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
</style>
</head>

<body>
    <nav class="horizontal">
    <header><i class="fas fa-shopping-cart"></i>F.T.S</header>
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
                    <th>Business Unit Name</th>
                    <th>Amount</th>
                    <th>Date Added</th>
                    <th>Action</th>

                  </tr>

    <?php 
                 include '../conect.php';
                    $sql = "SELECT * FROM proceeds";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                                echo '
                                <tbody>
                                <tr class="row">
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['amount'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>
                                    <button id="edit"><a href="viewBudget.php?edit='.$row['id'].'" class="edit"><i class="fas fa-edit" style="color: white;" aria-hidden="true"></i></a></button>
                                    <button id="del"><a href="viewBudget.php?delete=<?php echo '.$row['id'].'; ?>" class="delete" onclick="return confirm(\'Do you really want to delete this record?\');"><i class="fas fa-trash" style="color: white;" aria-hidden="true"></i></a></button>
                                    </td>
                                    </tr>
                                    
                            </tbody>';
                        }
                            }else{
                             echo 'connection failed';
                            }
                    
                $conn->close();
                
                
   ?>

            </table>
       
          </div>
          <div class="main-products">

          </div>
          <div class="main-products"></div>
          <div class="main-products"></div>

    </section>
    <section class="update">

<?php  
 if(isset($_GET['edit'])){
     $edit_id = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM proceeds WHERE id = '$edit_id'") or die('query failed');
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
</section>
<?php
          if(isset($_GET['update'])){
            $edit_id = $_GET['edit'];
             //updatting product after editinh
             $update_id = $_POST['up_id'];
             $name = $_POST['name'];
             $amt = $_POST['ammount'];
             $date = $_POST['date'];
             $update_query = mysqli_query($conn, "UPDATE proceeds SET name='$name', amount='$amt', date='$date' WHERE id='$update_id' ") or die('query failed');
      
     if($update_query !== TRUE){;
         echo "something went wrong";
      }
    }
?>
<?php






?>

</body>
</html>
