<?php
    if(!isset($_POST["pid"])){
        echo "error";
        exit;
    }
    include "database.php";
    $pid = $_POST["pid"];
    $q1 = "DELETE FROM product WHERE product_id = '$pid'";
    if(mysqli_query($con,$q1)){
        echo "<h1>Product successfully deleted<br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php");
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);
    }
    mysqli_close($con);

?>