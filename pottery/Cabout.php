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

    require_once('connection.php');

    if (isset($_POST['upload'])){
    $file=addslashes(file_get_contents($_FILES['image']["tmp_name"]));
    $name=$_POST['name'];
    $price=$_POST['price'];
    $qnty=$_POST['qnty'];
    $desc=$_POST['desc'];

    $query="insert into product (image,price,name,qnty,description) values ('$file','$price','$name','$qnty','$desc')";
    if(mysqli_query($con,$query)){
        echo "<script>alert('Image uploaded')</script>";
    }else{
        echo "<script>alert('Error!!!')</script>";
    }
    echo '<script>window.location="prod.php"</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title> Add Product </title>
    <meta charset="utf-8">
    <link rel="stylesheet" a href="css\add.CSS">

</head>
<body>
    <form action="add.php" method="POST" enctype="multipart/form-data">
<div class="container">
    <ul>
        <li ><a href="home.php">Home</a></li>
        <li><a href="prod.php">Product</a></li>
        <li class="active"><a href="add.php">Add Product</a></li>
        <li><a href="order.php">Ordered Product</a></li>
        <li><a href="graph.php">Statistics</a></li>
        <li><a href="message.php">Message</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="about.php">About Us</a></li>
    </ul>
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
    </div>

<div class="container1">
    <input type="hidden" name="size" value="1000000">
    <div>
        <input type="file" name="image" id="image" onchange="return fileValidate()">
    </div>
    <div class="form-input">
        <input type="text" name="name" id="name"   placeholder="Name of the product" />
    </div>
    <div class="form-input">
        <input type="text" name="price" id="price"   placeholder="Price of the product" />
    </div>
    <div class="form-input">
        <input type="text" name="qnty" id="qnty"  placeholder="Quantity of the product" />
    </div>
    <div class="form-input">
        <input type="text" name="desc" id="desc"  placeholder="Description of the product" />
    </div>
    <div>
        <input type="submit" name="upload" onclick="return infoValidate()" class="btn-submit" value="Upload">
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
	function fileValidate() {
			var image_name = document.getElementById("image");
			var imagePath = image_name.value;
			var extension =/(\.jpg|\.jpeg|\.png|\.gif)$/i; 
			if(!extension.exec(imagePath)){
				alert("Invalid image file");
				image_name='';
				return false;
			}
		}

	function infoValidate(){
		var name = document.getElementById("name");
		var price = document.getElementById("price");
		var qnty = document.getElementById("qnty");
		var desc = document.getElementById("desc");
		if(name.value=='' || price.value=='' || qnty.value=='' || desc.value==''){
				alert("Please fill out all the feild!!!");
				return false;
			}
	}
</script>