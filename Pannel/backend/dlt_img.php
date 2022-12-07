<?php
    if(!isset($_POST["dpid"])){
        exit;
    }
    include "database.php";
    $dpid = $_POST["dpid"];
    $pid = $_POST["pid"];
    $q = "DELETE FROM media WHERE image_code = '$dpid'";
    if(mysqli_query($con,$q)){
        echo "<h1>Successfully deleted<br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);
    }
    mysqli_close($con);

?>