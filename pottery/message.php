<?php
require_once('connection.php');
session_start();
    if(isset($_POST['login']))
    {
            $username=($_POST['username']);
            $password=($_POST['password']);
            $password=md5($password);
            $query="select * from user where username='$username' and password='$password'";
            $result=mysqli_query($con,$query);
            $type="";
            $id="";

            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_array($result)){
                    $type=$row["type"];
                    $id=$row["id"];

                    if($row["type"]=="admin"){
                        $_SESSION['userid']=$row["id"];
                        header('location:home.php');
                    }else{
                        $_SESSION['userid']=$row["id"];
                        header("location:Chome.php");

                    }
                }
            }
            else{
                echo "<script>alert('Username or password is wrong')</script>";
            }
    }




?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" a href="css\design.CSS">

</head>
<body>
	<div class="container">
	<img src="image/login.png"/>
		<form action="login.php" onsubmit="return Validate()" name="vform" method="POST" >
        <div id="username_div">
		<div class="form-input">
		<input type="text" name="username" placeholder="User Name"/>
        <div id="name_error"></div>
        </div>
		</div>
        
		<div class="form-input">
        <div id="password_div">
		<input type="password" name="password" placeholder="Password"/>
        <div id="password_error"></div>
        </div>
		</div>
		<input type="submit" name="login" value="Login"  class="btn-login"/>
		<p style="color:white">Not registered yet?  <a style="color:white" href="reg.php">Sign up here</a>
            </p>
		</form>
	</div>

</body>
</html>

<script type="text/javascript">
    var username = document.forms['vform']['username'];
    var password = document.forms['vform']['password'];

    var name_error = document.getElementById('name_error');
    var password_error = document.getElementById('password_error');

    username.addEventListener('blur', nameVerify, true);
    password.addEventListener('blur', passwordVerify, true);

    function Validate() {
  
  if (username.value == "") {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }
  
  if (username.value.length < 3) {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username must be at least 3 characters";
    username.focus();
    return false;
  }

  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
  }
}
</script>

