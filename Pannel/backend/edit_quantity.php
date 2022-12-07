<?php
    if(!isset($_POST["quantity"])){
        echo "error";
        exit;
    }
    include "database.php";
    $quantity = $_POST["quantity"];
    $pid = $_POST["pid"];

    $q1 = "UPDATE product SET quantity = '$quantity' WHERE product_id = '$pid'";
    if(mysqli_query($con,$q1)){
        echo "<h1>Quantity edit Successfully <br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);  
    }

    mysqli_close($con);
?>