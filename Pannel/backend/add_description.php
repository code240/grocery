<?php
    if(!isset($_POST["des"])){
        echo "error";
        exit;
    }
    include "database.php";
    $des = $_POST["des"];
    $pid = $_POST["pid"];
    date_default_timezone_set('Asia/Kolkata');

    $time = date("d_m_y_h_i_s_");
    $explode = explode(".",microtime());
    $microtime = $explode[1];
    $des_code = "Description_".$time.$microtime;

    $q1 = "INSERT INTO specification (description,data_code,product_id) VALUES ('$des','$des_code','$pid')";
    if(mysqli_query($con,$q1)){
        echo "<h1>Description Successfully Added...</h1>";
        header("refresh:2;url=../Product.php?display=".$pid); 
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header("refresh:4;url=../Product.php?display=".$pid);
    }
    mysqli_close($con);
?>