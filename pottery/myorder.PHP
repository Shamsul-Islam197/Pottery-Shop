 <?php
        session_start();
        require_once('connection.php');
        if(isset($_SESSION['userid'])){ 
            $query="SELECT * FROM `message` ORDER BY time ASC";
            $result=mysqli_query($con,$query);
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
	<title> Message</title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\message.CSS">

</head>
<body>
    <form action="message.php" method="POST" >
	<div class="container">
    <ul>
    	<li><a href="home.php">Home</a></li>
    	<li><a href="prod.php">Product</a></li>
    	<li><a href="add.php">Add Product</a></li>
        <li ><a href="order.php">Ordered Product</a></li>
        <li><a href="graph.php">Statistics</a></li>
    	<li class="active"><a href="message.php">Message</a></li>
        <li><a href="user.php">User</a></li>
    	<li><a href="about.php">About Us</a></li>
    </ul>
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
	</div>




<table class="content-table">
    <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Receive Time</th>
    </tr>
  </thead>
                <?php
                    while($rows=mysqli_fetch_assoc($result))
                    {
                            ?>
                        <tr>
                            <td>
                                <?php echo $rows["name"]?>
                            </td>
                            <td>
                                <?php echo  $rows["email"]?>
                            </td>
                            <td>
                                <?php echo $rows["message"] ?>
                            </td>
                            <td>
                                <?php echo $rows["time"] ?>
                            </td>

                        </tr>

                     <?php
                    }
                 ?>
        </table>










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