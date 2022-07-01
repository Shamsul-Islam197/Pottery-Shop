<?php
	session_start();
         if(isset($_POST['logout'])){
            if(isset(($_SESSION['userid']))){
                session_destroy();
                header('location:login.php');
            }else{
                echo '<script>alert("Not logged in yet!!!")</script>';
            }
            
        }

        require_once('connection.php');


        if(isset($_POST['message'])){
            if(!isset($_SESSION['userid'])){
            echo "<script>alert('Please login first...')</script>";
            echo '<script>window.location="login.php"</script>';
        }else{

            $name=$_POST['name'];
            $email=$_POST['email'];
            $msg=$_POST['msg'];

            $query="INSERT INTO `message` (`name`, `email`, `message`) VALUES ('$name', '$email', '$msg')";

            if(mysqli_query($con,$query)){
                echo "<script>alert('Message sent')</script>";
            }else{
                echo "<script>alert('Something went wrong!!!')</script>";
    }
        }
    }


?>

<!DOCTYPE html>
<html>
<head>
	<title> Contact Us </title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\contact.CSS">
    <link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <form action="contact.php" method="POST">
<div class="container">
    <ul>
    	<li><a href="Chome.php">Home</a></li>
    	<li><a href="Cbuy.php">Product</a></li>
    	<li class="active"><a href="contact.php">Contact</a></li>
    	<li ><a href="Cabout.php">About Us</a></li>
        <li><a href="myorder.php">My Order</a></li>
        <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>

            <?php
                    if (isset($_SESSION["cart"])){
                        $cart_count=count($_SESSION['cart']);
                    }else{
                        $cart_count=0;
                    }
                        ?>
                        Cart <span><sup><?php echo $cart_count; ?></sup></span>


        </a></li>
    </ul>
	</div>


    <div class="header">
        <h1>Contact Us</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

    <div class="form">
        <form>
            <input type="text" name="name" placeholder="Name" />
            <input type="text" name="email" placeholder="Email" />
            <input type="text" name="msg" placeholder="Message" />
        </form>
        <button type="submit" name="message" style="padding: 15px 25px; font-size: 16px; background: #0078ff; border: none; border-radius: 4px; margin-top: 15px; color: #fff;">Let's Talk</button>
    </div>

</form>

</body>
</html>




<script type="text/javascript">
    function Confirmation(){
    var x=confirm("Are you sure?")
    if(x==true){
        return true;
    }else{
        return false;
    }
}
		
</script>