<?php
    if(!isset($_POST["dpid"])){
        exit;
    }
    include "database.php";
    $dpid = $_POST["dpid"];
    $pid = $_POST["pid"];
    $q1 = "UPDATE media SET active_image = '0' WHERE product_id = '$pid'";
    $q2 = "UPDATE media SET active_image = '1' WHERE image_code = '$dpid'";
    if(mysqli_query($con,$q1)){
        if(mysqli_query($con,$q2)){
            echo "<h1>Image Pinned Successfully <br>Redirecting....</h1>";
            header( "refresh:2;url=../Product.php?display=".$pid);
        }else{
            echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
            header( "refresh:4;url=../Product.php?display=".$pid);    
        }
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);
    }


?>