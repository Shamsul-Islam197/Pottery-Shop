 <?php
        session_start();
        if(isset($_SESSION['userid'])){ 
        }else{
            header('location:login.php');
        }
        
         if(isset($_POST['logout'])){
            if(isset(($_SESSION['userid']))){
                session_destroy();
                header('location:login.php');
            }
            
        }


?>
<!DOCTYPE html>
<html>
<head>
	<title> Home</title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\home.CSS">

</head>
<body>
    <form action="home.php" method="POST" >
	<div class="container">
    <ul>
    	<li class="active"><a href="home.php">Home</a></li>
    	<li><a href="prod.php">Product</a></li>
    	<li><a href="add.php">Add Product</a></li>
        <li><a href="order.php">Ordered Product</a></li>
        <li><a href="graph.php">Statistics</a></li>
    	<li><a href="message.php">Message</a></li>
        <li><a href="user.php">User</a></li>
    	<li><a href="about.php">About Us</a></li>
    </ul>
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
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