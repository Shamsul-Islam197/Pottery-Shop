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

    $name="";
    $price="";
    $qnty="";
    $desc="";
    
    $id = $_GET['GetID'];
    $query = " select * from product where id='".$id."'";
    $result = mysqli_query($con,$query);

    while($rows=mysqli_fetch_assoc($result))
    {
        $id=$rows['id'];
        $price=$rows['price'];
        $name=$rows['name'];
        $qnty=$rows['qnty'];
        $desc=$rows['description'];
    }

    if(isset($_POST['update']))
    {
        $id=$_POST['id'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $qnty=$_POST['qnty'];
        $desc=$_POST['desc'];

        $query = " update product set name ='".$name."', price='".$price."' ,qnty='".$qnty."' ,description='".$desc."' where id='".$id."'";
    if(mysqli_query($con,$query)){
        echo "<script>alert('Data Updated')</script>";
    }else{
        echo "<script>alert('Error!!!')</script>";
    }
    echo '<script>window.location="prod.php"</script>';
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title> Product </title>
    <meta charset="utf-8">
    <link rel="stylesheet" a href="css\add.CSS">

</head>
<body>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
<div class="container">
    <ul>
        <li ><a href="home.php">Home</a></li>
        <li><a href="prod.php">Product</a></li>
        <li><a href="add.php">Add Product</a></li>
        <li ><a href="order.php">Ordered Product</a></li>
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
        <input type="file" name="image"  onchange="return fileValidate()">
    </div>
    <div class="form-input">
        <input type="text" name="id"   placeholder="ID of the product" value="<?php echo $id; ?>"/>
    </div>
    <div class="form-input">
        <input type="text" name="name"   placeholder="Name of the product" value="<?php echo $name; ?>"/>
    </div>
    <div class="form-input">
        <input type="text" name="price"   placeholder="Price of the product" value="<?php echo $price; ?>"/>
    </div>
    <div class="form-input">
        <input type="text" name="qnty"  placeholder="Quantity of the product" value="<?php echo $qnty; ?>"/>
    </div>
    <div class="form-input">
        <input type="text" name="desc"  placeholder="Description of the product" value="<?php echo $desc; ?>"/>
    </div>
    <div>
        <input type="submit" name="update" onclick="return infoValidate()" class="btn-submit" value="Update">
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