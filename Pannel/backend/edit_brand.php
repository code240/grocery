<?php
    if(!isset($_POST["brandname"])){
        echo "error";
        exit;
    }
    include "database.php";
    $brandname = $_POST["brandname"];
    $pid = $_POST["pid"];

    $q1 = "UPDATE product SET brand = '$brandname' WHERE product_id = '$pid'";
    if(mysqli_query($con,$q1)){
        echo "<h1>Brandname edit Successfully <br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);  
    }

    mysqli_close($con);
?>