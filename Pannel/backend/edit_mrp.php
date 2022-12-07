<?php
    if(!isset($_POST["mrp"])){
        echo "error";
        exit;
    }
    include "database.php";
    $mrp = $_POST["mrp"];
    $pid = $_POST["pid"];
    if(!is_numeric($mrp)){
        echo "MRP you entered is not numeric";
        exit;
    }
    $q1 = "SELECT selling_price FROM product WHERE product_id = '$pid'";
    $get_sell = mysqli_query($con,$q1);
    while($r=mysqli_fetch_assoc($get_sell)){
        $sell = $r["selling_price"];
    }
    $sell_int = (int)$sell;
    $mrp_int = (int)$mrp;
    
    if($sell_int>$mrp_int){
        echo "You cannot sell the product above the market price";
        exit;
    }
    
    $x = (100-(($sell_int/$mrp_int)*100));
    $discount = round($x);

    $q2 = "UPDATE product SET mrp = '$mrp',discount = '$discount' WHERE product_id = '$pid'";
    if(mysqli_query($con,$q2)){
        echo "<h1>MRP edit Successfully <br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);  
    }

    mysqli_close($con);
?>