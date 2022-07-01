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

        if(isset($_GET['GetID'])){
        $id=($_GET['GetID']);
        $query="DELETE FROM product where id='$id' ";
        if(mysqli_query($con,$query)){
        echo "<script>alert('Product Deleted')</script>";
    }else{
        echo "<script>alert('Error!!!')</script>";
    }
    }


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

	

?>

<!DOCTYPE html>
<html>
<head>    
    <title>Product</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
        table th{
            background-color: #efefef;
        }
    </style>
</head>
<body>
    <form action="prod.php" method="POST" enctype="multipart/form-data">
    <link rel="stylesheet" a href="css\prod.CSS">
    <div class="container1">
    <ul>
        <li ><a href="home.php">Home</a></li>
        <li class="active"><a href="prod.php">Product</a></li>
        <li><a href="add.php">Add Product</a></li>
        <li><a href="order.php">Ordered Product</a></li>
        <li><a href="graph.php">Statistics</a></li>
        <li><a href="message.php">Message</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="about.php">About Us</a></li>
    </ul>
    <input type="submit" name="logout" onclick="return Confirmation()" value="Log Out" class="btn-logout"/>
    </div>


    <div class="form_input">
        <input type="text" name="search" placeholder="Search product..."/>
    </div>

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




        <?php
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-3">

                            <div class="product">
                         
                                <?php echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" style="width: 300px;height: 200px;" class="img-responsive">';?>
                                <h5 class="text-info">ID : <?php echo $row["id"]; ?></h5>
                                <h5 class="text-info"><?php echo $row["name"]; ?></h5>
                                <h5 class="text-danger">TK.<?php echo $row["price"]; ?></h5>
                                <h5 class="text-info">Quantity: <?php echo $row["qnty"]; ?></h5>
                                <a style="margin-top: 5px;" class="btn btn-success" href="edit.php?GetID=<?php echo $row["id"] ?>">Edit</a>
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <a href="prod.php?GetID=<?php echo $row["id"] ?>" name="delete" onclick="return Delete()" style="margin-top: 5px;background: #FE6969; text-decoration: none;"class="btn btn-success" >Delete</a>
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
	function Delete(){
	var x=confirm("Are you want to delete?")
	if(x==true){
		return true;
	}else{
		return false;
	}

    }

    function Confirmation(){
    var x=confirm("Are you sure?")
    if(x==true){
        return true;
    }else{
        return false;
    }
}
		
</script>