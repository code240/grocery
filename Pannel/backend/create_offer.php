<?php
    if(!isset($_POST["offername"])){
        echo "error";
        exit;
    }
    include "database.php";
    $offer = $_POST["offername"];
    date_default_timezone_set('Asia/Kolkata');
    $time = date("dmyhis");
    $offcode = "dbm_offer".$time;

    $q1 = "INSERT INTO offer (offer_name,offer_code) VALUES ('$offer','$offcode')";
    if(mysqli_query($con,$q1)){
        echo "<h1>Offer successfully created...</h1>";
        header("refresh:2;url=../Offer");
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header("refresh:2;url=../Offer");
    }

?>