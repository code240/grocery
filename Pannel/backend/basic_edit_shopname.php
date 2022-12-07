<?php
    if(!isset($_POST["shopname"])){
        echo "error";
        exit;
    }
    include "database.php";

    $data = $_POST["shopname"];
    $q1 = "UPDATE basic_data SET shop_name = '$data' WHERE id=1";
    if(mysqli_query($con,$q1)){
        echo "<h1>Change Successfully applied...</h1>";
        header("refresh:2;url=../Setting");
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header("refresh:2;url=../Setting");
    }
    mysqli_close($con);

?>