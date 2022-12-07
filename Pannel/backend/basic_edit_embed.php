<?php
    if(!isset($_POST["embed"])){
        echo "error";
        exit;
    }
    include "database.php";

    $data = $_POST["embed"];
    $q1 = "UPDATE basic_data SET embed_map = '$data' WHERE id=1";
    if(mysqli_query($con,$q1)){
        echo "<h1>Change Successfully applied...</h1>";
        header("refresh:2;url=../Setting");
    }else{
        echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
        header("refresh:2;url=../Setting");
    }
    mysqli_close($con);

?>