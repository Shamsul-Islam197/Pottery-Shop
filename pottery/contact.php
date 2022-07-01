<?php

    $con=mysqli_connect('localhost','root','','pottery');

    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>

