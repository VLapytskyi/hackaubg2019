<?php

include_once("init_session.php");
include_once('config.php');

function display_login_page () {

    $_SESSION['parent_id'] = FALSE;
    $_SESSION['child_id'] = FALSE;
    $_SESSION['child_mode'] = FALSE;

    $burl = $GLOBALS['projectbaseurl'];

    // ATTENTION: Here is the login page
//___________________________________________________________________________________________________________________________
    ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="resources/logo.png">
<title>Login &mdash; Loopy</title>
<?php
    if (isset($_SESSION['error_message'])) {
        echo '<script> alert("'.$_SESSION['error_message'].'"); </script>';
    }
?>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
	margin-left: 0;
	background-color: #ccc;
    }

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #212121;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  padding: 10px 14px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.logo {
  width: 13em;
  border-radius: 13em;
}

.container {
  padding: 16px;
  width:30%;
  margin-left: 35%;
}
.container input{
  left:20%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #ffcc99;
  margin: auto;
  border: 1px solid #888;
  width: 60%; 
  border-radius: 10px;
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.9s;
  animation: animatezoom 0.6s
}
.buttons{
  margin-top: 10%;
}
.buttons button{
  background-color:#212121;
  border-radius: 5px;
}

footer{
  background-color: #212121;
  color: #fff;
  padding: 15px;
  position:absolute;
  bottom: 0;
  width: 100%;
}
.footer-span{
  display: block;
  text-align: center;
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 600px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
  <div class="buttons" align="center">
  <img src="resources/logo.png" alt="Logo" class="logo">
<br>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>
</div>
<div id="id01" class="modal">
  <form method="post" class="modal-content animate" action="handlers/login.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="resources/logo.png" alt="Logo" class="logo">
    </div>

    <div class="container">
      <label for="login_email"><b>Email</b></label>
      <input type="text" color=black placeholder="Email" name="login_email" required>

      <label for="login_password"><b>Password</b></label>
      <input type="password" placeholder="Password" name="login_password" required>
        
      <button type="submit">Login</button>
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>

    <!-- <div class="container">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div> -->
  </form>
</div>


<div id="id02" class="modal">
  
  <form method="post" class="modal-content animate" action="handlers/register.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="resources/logo.png" alt="Logo" class="logo">
    </div>

    <div class="container">
      <label for="register_name"><b>Full Name</b></label>
      <input type="text" color=black placeholder="Full Name" name="register_name" required>

      <label for="register_email"><b>Email</b></label>
      <input type="text" color=black placeholder="Email" name="register_email" required>

      <label for="register_password"><b>Password</b></label>
      <input type="password" placeholder="Password" name="register_password" required>

      <label for="register_repassword"><b>Retype Password</b></label>
      <input type="password" placeholder="Retype Password" name="register_repassword" required>
        
      <button type="submit">Register</button>      
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<footer>
  <span class="footer-span">Loopy 0.9-beta</span>
</footer>

<script>
window.onclick = function(event) {
    if (event.target == document.getElementById('id01')) {
        document.getElementById('id01').style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == document.getElementById('id02')) {
        document.getElementById('id02').style.display = "none";
    }
}
</script>


</body>
</html>

    <?php
//______________________________________________________________________________________________________
    // ATTENTION: Here the login page ends

    unset($_SESSION['error_message']);
}

function goto_login_error($message) {
    init_session();

    $_SESSION['parent_id'] = FALSE;
    $_SESSION['child_id'] = FALSE;
    $_SESSION['child_mode'] = FALSE;
    $_SESSION['error_message'] = $message;

    header('Location: '.$GLOBALS['projectbaseurl']);
    exit;
}

?>