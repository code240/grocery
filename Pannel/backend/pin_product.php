<?php
    if(!isset($_GET["pin"]) && !isset($_GET["pid"])){
        echo "error";
        exit;
    }
    $pin = $_GET["pin"];
    $pid = $_GET["pid"];

    if($pin != "1" && $pin != 0){
        echo "error";
        exit;
    }
    include "database.php";
    $q1 = "SELECT * FROM product WHERE product_id = '$pid'";
    $get_q1 = mysqli_query($con,$q1);
    $num_rows = mysqli_num_rows($get_q1);
    if($num_rows!=1){
        echo "error";
        mysqli_close($con);
        exit;
    }
    $q2 = "UPDATE product SET pin = '$pin' WHERE product_id = '$pid'";
    if(mysqli_query($con,$q2)){
        echo "<h1>Change successfully applied<br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);
    }
    mysqli_close($con);

?>