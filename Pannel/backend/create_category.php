<?php
    if(!isset($_POST["cat"])){
        echo "error";
        exit;
    }
    include "database.php";
    $cat = $_POST["cat"];
    date_default_timezone_set('Asia/Kolkata');
    $time = date("dmyhis");
    $catcode = "dbm_category".$time;

    $q1 = "INSERT INTO category (cat_name,cat_code) VALUES ('$cat','$catcode')";
    if(mysqli_query($con,$q1)){
        echo "<h1>Category successfully created...</h1>";
        header("refresh:2;url=../Category");
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header("refresh:2;url=../Category");
    }

    mysqli_close($con);
?>