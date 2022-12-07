<?php
    if(!isset($_POST["offer"]) || !isset($_POST["ofcode"])){
        echo "error";
        exit;
    }
    include "database.php";
    $offername = $_POST["offer"];
    $ofcode = $_POST["ofcode"];
    
    $q1 = "UPDATE offer SET offer_name = '$offername' WHERE offer_code = '$ofcode'";
    if(mysqli_query($con,$q1)){
        echo "<h1>Offer name successfully edit.<br>Redirecting....</h1>";
        header( "refresh:2;url=../Offer");
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Offer");  
    }
?>