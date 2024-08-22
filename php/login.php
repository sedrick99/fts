<?php
session_start();
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            margin: 0;
        }
.bg_image
{
margin: 0;
padding: 0;
font-family: montserrat;    
size: 100%;
height:100vh;
background: grey;
background-size: cover;
overflow: hidden;

}
.center{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
  background: white;
  border-radius: 10px;


}
h1{
    text-align: center;
    padding: 0 0 20px;
    color: rgb(7, 125, 184);
}
form{
    padding: 0 40px;
    box-sizing: border-box;

}
.text_field{
    position: relative;
    border-bottom:  2px solid #adadad;
    margin: 30px 0;
}
input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 15px;
    border: none;
    background: none;
    outline: none;

}
label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    pointer-events: none;
}
span::before
{
 content: '';
 position: absolute;
 top: 40px;
 left: 0;
 width: 100%;
 height: 2px;
 background-color:  rgb(7, 125, 184);
}
.text_field input:focus ~ label,
.text_field input:valid ~ label{
    top: 5px;
    color:  #042331;
}
.text_field input:focus ~ span::before,
.text_field input:focus ~ span::before{
 width: 100%;

}
.pass
{
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;

} 
.pass:hover{
    text-decoration: underline;

}
button {
    width: 100%;
    height: 50px;
    border: 1px solid;
    background:  rgb(7, 125, 184);
    border-radius: 25px;
    font-size: 20px;
    color: white;
    font-weight: 700;
    margin-bottom: 10px;
    cursor: pointer;
    outline: none;

}
button:hover{
    background:rgb(7, 100, 184);
    transform: scaleX(1.2);
    transition: .6s;
}
input[type="submit"]:hover{
    border-color:   #042331;
    transition: .5s;
}
.signup_link{
    margin: 30px 0;
    text-align: center;
    font-size: 15px;
    color: #666666;

}
.signup_link a {
    color: #2691d9;
    text-decoration: none;

}
.signup_link a:hover{
    text-decoration: underline;

}
.wel{
    text-align: center;
    color: rgb(14, 12, 11);
    font-size: 40px;
}
.aco{
    color: white;
}

.error {    display: none;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 20px;
            width: 76%;
            margin-left: 3rem;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="bg_image">
    <h2 class="wel">WELCOME</h2>
    <div class="center">
        <h1>Login</h1>
        <div id="error-message" class="error"></div>
        <script>
        window.onload = function() {
            var error = "<?php echo $error; ?>";
            if (error) {
                document.getElementById('error-message').textContent = error;
                document.getElementById('error-message').style.display = 'block';
            }
        }
    </script>
        <form id="loginForm" action="log.php" method="post">
            <div class="text_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="text_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>
</body>
</html>