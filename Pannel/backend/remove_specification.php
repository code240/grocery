<?php

    if(!isset($_POST["desToBeRemoved"])){
        echo "error";
        exit;
    }
    include "database.php";
    $descode = $_POST["desToBeRemoved"];
    $pid = $_POST["pid"];

    $q1 = "DELETE FROM specification WHERE data_code = '$descode'";
    if(mysqli_query($con,$q1)){
        echo "<h1>Line removed successfully <br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid); 
    }
    mysqli_close($con);
?>