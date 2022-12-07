<?php
    if(!isset($_POST["shortaddress"])){
        echo "error";
        exit;
    }
    include "database.php";

    $data = $_POST["shortaddress"];
    $q1 = "UPDATE basic_data SET short_address = '$data' WHERE id=1";
    if(mysqli_query($con,$q1)){
        echo "<h1>Change Successfully applied...</h1>";
        header("refresh:2;url=../Setting");
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header("refresh:2;url=../Setting");
    }
    mysqli_close($con);

?>