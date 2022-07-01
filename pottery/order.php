 <?php
        session_start();
        require_once('connection.php');
        if(isset($_SESSION['userid'])){
        }else{
            echo "<script>alert('Please login first...')</script>";
            echo '<script>window.location="login.php"</script>';
        }
        
         if(isset($_POST['logout'])){
            if(isset(($_SESSION['userid']))){
                session_destroy();
                header('location:login.php');
            }
            
        }


            $userid=$_SESSION['userid'];

            $query="SELECT * FROM `order` WHERE customer_id='$userid' Order BY status DESC";
            $result=mysqli_query($con,$query);

        


?>
<!DOCTYPE html>
<html>
<head>
	<title>My Order</title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\myorder.CSS">
    <link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <form action="myorder.php" method="POST" >
	<div class="container">
    <ul>
    	<li><a href="Chome.php">Home</a></li>
        <li><a href="Cbuy.php">Product</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="Cabout.php">About Us</a></li>
        <li class="active"><a href="myorder.php">My Order</a></li>
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

	</div>





<table class="content-table">
    <thead>
    <tr>
      <th>Product Name</th>
      <th>Product Image</th>
      <th>Quantity</th>
      <th>price</th>
      <th>Total</th>
      <th>Ordered Date</th>
      <th>Order Status</th>
    </tr>
  </thead>
                <?php
                    while($rows=mysqli_fetch_assoc($result))
                    {
                            ?>
                        <tr>
                            <td>
                                <?php echo $rows["product_name"]?>
                            </td>


                            <td>
                                <?php

                                    $query4="SELECT `image` FROM `product` WHERE `id`='".$rows["product_id"]."'";
                                    $result4=mysqli_query($con,$query4);
                                    while($rows1=mysqli_fetch_assoc($result4)){
                                         echo '<img src="data:image;base64,'.base64_encode($rows1['image']).'" style="width: 100px;height: 100px;">';
                                    }
                                ?>
                            </td>




                            
                            <td>
                                <?php echo  $rows["product_qnty"]?>
                            </td>
                            
                            <td>
                                TK. <?php echo $rows["product_price"] ?>
                            </td>
                            <td>
                                TK.<?php echo number_format($rows["product_qnty"] * $rows["product_price"]) ?>
                            </td>
                            
                            
                            <td>
                                <?php echo  $rows["date"] ?>
                            </td>
                            <td>
                                <a href="order.php?Getdate=<?php echo $rows["date"] ?>" name="delivered" onclick="return Confirmation()" style="border:0;background: rgb(77, 78, 101);display: block;margin:20px auto;text-align: center;border:1px solid #2ecc71;padding:6px 12px;outline:none;color:white;border-radius:10px;transition: 0.5s;cursor:pointer;text-decoration: none;" ><?php echo  $rows["status"] ?></a>
                                
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