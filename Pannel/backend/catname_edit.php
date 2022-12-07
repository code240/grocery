<?php
    if(!isset($_POST["cat"]) || !isset($_POST["catcode"])){
        echo "error";
        exit;
    }
    include "database.php";
    $catname = $_POST["cat"];
    $catcode = $_POST["catcode"];
    
    $q1 = "UPDATE category SET cat_name = '$catname' WHERE cat_code = '$catcode'";
    if(mysqli_query($con,$q1)){
        echo "<h1>Category name successfully edit.<br>Redirecting....</h1>";
        header( "refresh:2;url=../Category");
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Category");  
    }
?>