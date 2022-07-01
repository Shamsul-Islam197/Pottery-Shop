 <?php
        session_start();
        require_once('connection.php');
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


        if(isset($_POST['search_btn'])){
        $search=($_POST['search']);
        $search1=($_POST['search1']);

        if ($search!='' && $search1=='') {
            $query="SELECT * FROM `order`   WHERE `product_name` like '%$search%' ORDER BY `date` DESC";
            $result=mysqli_query($con,$query);
        }elseif ($search=='' && $search1!='') {
            $query1="SELECT `id` FROM `user`   WHERE `username` like '%$search1%' ";
            $result1=mysqli_query($con,$query1);
             while($row=mysqli_fetch_assoc($result1)){
                        $id=$row["id"];              
                    }
            $query="SELECT * FROM `order`   WHERE `customer_id`='$id' ORDER BY `date` DESC";
            $result=mysqli_query($con,$query);
        }elseif ($search!='' && $search1!='') {
            $query1="SELECT `id` FROM `user`   WHERE `username` like '%$search1%' ";
            $result1=mysqli_query($con,$query1);
             while($row=mysqli_fetch_assoc($result1)){
                        $id=$row["id"];              
                    }
            $query="SELECT * FROM `order`   WHERE `customer_id`='$id' AND `product_name` like '%$search%'  ORDER BY `date` DESC";
            $result=mysqli_query($con,$query);
        }else{
            $query="SELECT * FROM `order` ORDER BY `status` DESC";
            $result=mysqli_query($con,$query);
        }
    
        }else{
            $query="SELECT * FROM `order` ORDER BY `status` DESC";
            $result=mysqli_query($con,$query);
        }

        

        if (isset($_GET['Getdate'])) {
            $date = $_GET['Getdate'];

            $query1 ="UPDATE `order` SET `status`='Delivered' WHERE `date`='$date' ";

            if(mysqli_query($con,$query1)){
                echo "<script>alert('Mark as delivered')</script>";
                 echo '<script>window.location="order.php"</script>';
                
             }else{
                echo "<script>alert('Something went wrong')</script>";
             }
        }

        


?>
<!DOCTYPE html>
<html>
<head>
	<title>Ordered Products</title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\order.CSS">

</head>
<body>
    <form action="order.php" method="POST" >
	<div class="container">
    <ul>
    	<li><a href="home.php">Home</a></li>
    	<li><a href="prod.php">Product</a></li>
    	<li><a href="add.php">Add Product</a></li>
        <li class="active"><a href="order.php">Ordered Product</a></li>
        <li><a href="graph.php">Statistics</a></li>
    	<li><a href="message.php">Message</a></li>
        <li><a href="user.php">User</a></li>
    	<li><a href="about.php">About Us</a></li>
    </ul>
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
	</div>

    <input type="text" name="search" class="search" placeholder="Search product..." value="" />
    <input type="text" name="search1" class="search" placeholder="Customer Name..." value="" />
    <button type="submit" name="search_btn" class="btn-search">Search</button>




<table class="content-table">
    <thead>
    <tr>
      <th>Product Name</th>
      <th>Product Image</th>
      <th>Quantity</th>
      <th>Buying price</th>
      <th>Retail price</th>
      <th>Total</th>
      <th>Profit</th>
      <th>Customer Name</th>
      <th>Customer Phone</th>
      <th>Customer Address</th>
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
                                <?php 

                                    $query2="SELECT `buy_price` FROM `product` where id='".$rows["product_id"]."'";
                                    $result2=mysqli_query($con,$query2);
                                    while($row=mysqli_fetch_assoc($result2)){
                                         echo "TK. "; echo $row["buy_price"];
                                         $tmp=number_format($rows["product_qnty"] * $row["buy_price"]);
                                         
                                    }
                                ?>
                            </td>
                            <td>
                                TK. <?php echo $rows["product_price"] ?>
                            </td>
                            <td>
                                TK.<?php echo number_format($rows["product_qnty"] * $rows["product_price"]) ?>
                            </td>
                            <td>
                                TK. <?php echo number_format(($rows["product_qnty"] * $rows["product_price"])-$tmp) ?>
                            </td>
                            <td>
                                <?php 

                                    $query3="SELECT * FROM `user` where id='".$rows["customer_id"]."'";
                                    $result3=mysqli_query($con,$query3);
                                    while($row=mysqli_fetch_assoc($result3)){
                                         echo  $row["username"];
                                         $phone=$row["phone"];
                                         $address=$row["address"];
                                         
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo  $phone ?>
                            </td>
                            <td>
                                <?php echo  $address ?>
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