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


?>
<!DOCTYPE html>
<html>
<head>
	<title> Home</title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\home.CSS">
    <link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <form action="Chome.php" method="POST" >
	<div class="container">
    <ul>
    	<li class="active"><a href="Chome.php">Home</a></li>
    	<li><a href="Cbuy.php">Product</a></li>
    	<li><a href="contact.php">Contact</a></li>
    	<li><a href="Cabout.php">About Us</a></li>
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
    <input type="submit" id="logout" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
	</div>

	<div class="slider-frame">
		<div class="slide-images">
			<div class="img-container">
				<img src="image/slide1.jpg">
			</div>
			<div class="img-container">
				<img src="image/slide2.jpg">
			</div>
			<div class="img-container">
				<img src="image/slide3.jpg">
			</div>
			<div class="img-container">
				<img src="image/slide4.jpg">
			</div>
		</div>
	</div>	

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
