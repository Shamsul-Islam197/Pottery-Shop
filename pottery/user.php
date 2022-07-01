<?php
   require_once('connection.php');

if(isset($_POST['register'])){
        $username=($_POST['username']);
        $email=($_POST['email']);
        $phone=($_POST['phone']);
        $address=($_POST['address']);
        $password=($_POST['pass']);
        $password_2=($_POST['cpass']);

        if($password==$password_2){
            $password=md5($password);
            $query="INSERT INTO user(username,password,email,address,phone,type) VALUES('$username','$password','$email','$address','$phone','user')";
            $result=mysqli_query($con,$query);
            echo '<script>alert("Successfully registered")</script>';
            header("location:login.php");
        }
        }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" a href="css\reg.CSS">

</head>
<body>
	<div class="container">
	<img src="image/login.png"/>
	<form action="reg.php" method="POST" onsubmit="return Validate()" name="vform" >

        <div id="username_div">
		<div class="form_input">
		<input type="text" name="username" placeholder="User Name"/>
        <div id="name_error"></div>
        </div>
		</div>

        <div id="email_div">
		<div class="form_input">
		<input type="text" name="email" placeholder="Email"/>
        <div id="email_error"></div>
        </div>
    	</div>

        <div id="phone_div">
        <div class="form_input">
		<input type="text" name="phone" placeholder="Phone"/>
        <div id="phone_error"></div>
        </div>
    	</div>

    	<div id="address_div">
        <div class="form_input">
		<input type="text" name="address" placeholder="Address"/>
        <div id="address_error"></div>
        </div>
		</div>

        <div id="password_div">
		<div class="form-input">
		<input type="password" name="password" placeholder="Password"/>
		</div>
        </div>

        <div id="pass_confirm_div">
		<div class="form-input">
		<input type="password" name="password_confirm" placeholder="Confirm Password"/>
        <div id="password_error"></div>
        </div>
		</div>

		<input type="submit" name="register" value="Sign Up" class="btn-register"/>
		 <p style="color:white">Already registered?  <a style="color:white" href="login.php">Sign in here</a>
            </p>
		</form>
	</div>

</body>
</html>

<script type="text/javascript">

var username = document.forms['vform']['username'];
var email = document.forms['vform']['email'];
var password = document.forms['vform']['password'];
var password_confirm = document.forms['vform']['password_confirm'];
var phone = document.forms['vform']['phone'];
var address = document.forms['vform']['address'];

var name_error = document.getElementById('name_error');
var email_error = document.getElementById('email_error');
var password_error = document.getElementById('password_error');
var phone_error = document.getElementById('phone_error');
var address_error = document.getElementById('address_error');

username.addEventListener('blur', nameVerify, true);
email.addEventListener('blur', emailVerify, true);
phone.addEventListener('blur', phoneVerify, true);
address.addEventListener('blur', addressVerify, true);
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

  if (email.value == "") {
    email.style.border = "1px solid red";
    document.getElementById('email_div').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }

  if (phone.value == "") {
    phone.style.border = "1px solid red";
    document.getElementById('phone_div').style.color = "red";
    phone_error.textContent = "Phone number is required";
    phone.focus();
    return false;
  }

  if (address.value == "") {
    address.style.border = "1px solid red";
    document.getElementById('address_div').style.color = "red";
    address_error.textContent = "Address is required";
    address.focus();
    return false;
  }

  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
  }

  if (password.value != password_confirm.value) {
    password.style.border = "1px solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.innerHTML = "The two passwords do not match";
    return false;
  }
}

function nameVerify() {
  if (username.value != "") {
   username.style.border = "1px solid #5e6e66";
   document.getElementById('username_div').style.color = "#5e6e66";
   name_error.innerHTML = "";
   return true;
  }
}
function emailVerify() {
  if (email.value != "") {
    email.style.border = "1px solid #5e6e66";
    document.getElementById('email_div').style.color = "#5e6e66";
    email_error.innerHTML = "";
    return true;
  }
}

function phoneVerify() {
  if (phone.value != "") {
    phone.style.border = "1px solid #5e6e66";
    document.getElementById('phone_div').style.color = "#5e6e66";
    phone_error.innerHTML = "";
    return true;
  }
}

function addressVerify() {
  if (address.value != "") {
    address.style.border = "1px solid #5e6e66";
    document.getElementById('address_div').style.color = "#5e6e66";
    address_error.innerHTML = "";
    return true;
  }
}

function passwordVerify() {
  if (password.value != "") {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('pass_confirm_div').style.color = "#5e6e66";
    document.getElementById('password_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
  if (password.value === password_confirm.value) {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('pass_confirm_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
}
</script>
