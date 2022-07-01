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


    if(isset($_POST['search_btn'])){
        $search=($_POST['search']);
        $price=($_POST['price']);

        if($price!='' ){
            $query="SELECT * FROM `product`   WHERE `price`<='$price' AND `name` like '%$search%' ORDER BY `price` ASC";
            $result=mysqli_query($con,$query);
        }elseif($price=='' && $search!=''){
            $query="SELECT * FROM `product`   WHERE `name` like '%$search%' ORDER BY `price` ASC";
            $result=mysqli_query($con,$query);
        }else{
        $query = "SELECT * FROM product ORDER BY id ASC ";
        $result = mysqli_query($con,$query);
    }
    }else{
        $query = "SELECT * FROM product ORDER BY id ASC ";
        $result = mysqli_query($con,$query);
    }



    if (isset($_POST["add"])){
            $qnty=$_POST["quantity"];
            $tmp=$_POST["hidden_id"];
            $query = " SELECT * FROM `product` where id='".$tmp."'";
            $result = mysqli_query($con,$query);

            while($rows=mysqli_fetch_assoc($result)){
                    $a=$rows['qnty'];
            } 

            if($qnty>$a){
                echo "<script>alert('Not enough stock are available')</script>";
                echo '<script>window.location="Cbuy.php"</script>';
            } 

            else if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"hidden_id");

            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_POST["hidden_id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>alert("Product is added in the cart")</script>';
                echo '<script>window.location="Cbuy.php"</script>';
                
            }else{
                echo '<script>alert("Product is already added in Cart")</script>';
                echo '<script>window.location="Cbuy.php"</script>';
            }
                
        }else{
            $item_array = array(
                'product_id' => $_POST["hidden_id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
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
    <title>Proucts</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" a href="css\Cbuy.CSS">
    <link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
    </style>
</head>
<body>
    <form action="Cbuy.php" method="POST" enctype="multipart/form-data">
    <div class="container1">
    <ul>
        <li ><a href="Chome.php">Home</a></li>
        <li class="active"><a href="Cbuy.php">Product</a></li>
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
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
    </div>

        <input type="text" name="search" class="search" placeholder="Search product..." value="" />

        <select class="select-box" name="price">
        <div class="options-container">
        <option value="">Price Range</option>
        <option value="200">200 TK</option>
        <option value="400">400 TK</option>
        <option value="600">600 TK</option>
        <option value="800">800 TK</option>
        <option value="1000">1000 TK</option>
        </div>
        </select>

    <button type="submit" name="search_btn" class="btn-search">Search</button>


    <div class="container" style="width: 75%; margin-top:50px;" >
        <h2>Buy Now</h2>
        <?php
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-3">

                        <form method="post" action="Cbuy.php">

                            <div class="product">
                                <?php echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" style="width: 300px;height: 200px;" class="img-responsive">';?>
                                <h5 class="text-info"><?php echo $row["name"]; ?></h5>
                                <h5 class="text-danger">TK. <?php echo $row["price"]; ?></h5>
                                <h5 class="text-info"><?php echo $row["description"]; ?></h5>
                                <input type="text" name="quantity" required class="form-control" value="1" style="text-align: center;" />
                                <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>"/>
                                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>"/>
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>"/>
                                <input type="submit" name="add" onclick="return infoValidate()" style="margin-top: 5px;" class="btn btn-success"
                                       value="Add to Cart" />
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>


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