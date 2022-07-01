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
	<title> About Us </title>
	<meta charset="utf-8">
	<link rel="stylesheet" a href="css\about.CSS">
    <link rel="stylesheet" a href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <form action="Cabout.php" method="POST">
<div class="container">
    <ul>
    	<li><a href="Chome.php">Home</a></li>
    	<li><a href="Cbuy.php">Product</a></li>
    	<li><a href="contact.php">Contact</a></li>
    	<li class="active"><a href="Cabout.php">About Us</a></li>
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

<div class="team-section">
<h1>Our Team</h1>
<span class="border"></span>
<div class="ps">
<a href="#boy1"><img src="image/boy1.jpg" alt=""></a>
<a href="#girl"><img src="image/girl.jpg" alt=""></a>
<a href="#boy2"><img src="image/boy2.jpg" alt=""></a>
<a href="#girl2"><img src="image/girl2.jpg" alt=""></a>

</div>

<div class="section" id="boy1">
<span class="name">Shamsul Islam</span>
<span class="border"></span>
<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>

<div class="section" id="girl">
<span class="name">Mohima Rahman Sinthy</span>
<span class="border"></span>
<p>
	Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
</p>
</div>

<div class="section" id="boy2">
<span class="name">Jibon Islam</span>
<span class="border"></span>
<p>
	At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
</p>
</div>

<div class="section" id="girl2">
<span class="name">Monowara Sidique</span>
<span class="border"></span>
<p>
	Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
</p>
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