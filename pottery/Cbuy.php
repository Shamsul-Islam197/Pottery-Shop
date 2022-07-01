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

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo "<script>alert('Product has been Removed...!'')</script>";
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }






    if(isset(($_POST["order"]))){
        if(!isset($_SESSION['userid'])){
            echo "<script>alert('Please login first...')</script>";
            echo '<script>window.location="login.php"</script>';
        }else{
            
        $userid=$_SESSION['userid'];

        if(!empty($_SESSION["cart"])){
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $id = $value["product_id"];
                        $name = $value["item_name"];
                        $price = $value["product_price"];
                        $qnty = $value["item_quantity"];

                        

                        $query="INSERT INTO `order` (`customer_id`,`product_id`,`product_name`, `product_price`, `product_qnty`, `status`) VALUES ('$userid','$id','$name', '$price', '$qnty','waiting');";

                        $query2 = " SELECT * FROM `product` where id='".$id."'";

                        $result = mysqli_query($con,$query2);

                        while($rows=mysqli_fetch_assoc($result)){
                            $tmp=$rows['qnty'];
                        }
                        $tmp=$tmp-$qnty;
                        $query3="UPDATE `product` SET `qnty` = '".$tmp."' WHERE `product`.`id` = '".$id."'";
                        $result2=mysqli_query($con,$query3);
                        }

                        if(mysqli_query($con,$query)){
                         echo "<script>alert('Order Successfull')</script>";
                         echo '<script>window.location="Cbuy.php"</script>';
                         unset($_SESSION["cart"]);
                        }else{
                            echo "<script>alert('Error')</script>";

                        }
                        
                    }
                }
    }

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" a href="css\cart.CSS">
    <link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <form action="cart.php" method="POST" enctype="multipart/form-data">
    <div class="container1">
    <ul>
        <li ><a href="Chome.php">Home</a></li>
        <li><a href="Cbuy.php">Product</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="Cabout.php">About Us</a></li>
        <li><a href="myorder.php">My Order</a></li>
        <li class="active"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>

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
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
    </div>



        <div style="clear: both"></div>
        <?php
        if(!empty($_SESSION["cart"])){
            ?>
        <h3 class="title2">Your Cart Details</h3>
        <div class="table-responsive">

            <table class="content-table">
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Price Details</th>
                <th>Total Price</th>
                <th>Remove Item</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td>
                                <?php

                                    $query="SELECT `image` FROM `product` WHERE `id`='".$value["product_id"]."'";
                                    $result=mysqli_query($con,$query);
                                    while($rows=mysqli_fetch_assoc($result)){
                                         echo '<img src="data:image;base64,'.base64_encode($rows['image']).'" style="width: 200px;height: 150px;">';
                                    }
                                ?>
                            </td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>TK. <?php echo $value["product_price"]; ?></td>
                            <td>
                                TK. <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        onclick="return Confirmation()" class="text-danger">Remove Item</span></a></td>

                        </tr>
                        <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="5" align="right">Total</td>
                            <th align="right">TK. <?php echo number_format($total, 2); ?></th>
                            
                            
                        </tr>

                        <tr>
                            <td colspan="6" align="right"><input type="submit" name="order" onclick="return Confirmation()" style="margin-top: 5px;" class="btn btn-success"
                                       value="Place Order"></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        <?php 
        }else{
            ?>
            <h3 class="title2">Your cart is empty</h3>
        <?php
        }
        ?>
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

    function infoValidate(){
        var qnty = document.getElementById("quantity");
        if(qnty.value==''){
            alert("Please enter quantity!!!");
            return false;
            }
    }
        
</script>