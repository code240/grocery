<?php
    if(!isset($_POST["oldps"]) || !isset($_POST["newps"]) || !isset($_POST["cps"])){
        echo "error";
        exit;
    }
    $old = $_POST["oldps"];
    $newps = $_POST["newps"];
    $cps = $_POST["cps"];
    if($newps != $cps){
        echo "<h1>The new password could not be verified</h1>";
        header("refresh:4;url=../Setting");
        exit;
    }
    include "database.php";
    $q1 = "SELECT * FROM basic_data";
    $get_ps = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_ps)){
        $password_stored = $r["password"];
    }
    if(base64_encode($old) == $password_stored){
        $p = base64_encode($newps);
        $q2 = "UPDATE basic_data SET password = '$p' WHERE id = 1"; 
        if(mysqli_query($con,$q2)){
            echo "<h1>Password Change Successfully<br>Redirecting...</h1>";
            header("refresh:2;url=../Setting");
            mysqli_close($con);
            exit;    
        }else{
            echo "<h1>Unexpected Error<br>Redirecting...</h1>";
            header("refresh:4;url=../Setting");
            mysqli_close($con);
        exit;
        }
    }else{
        echo "<h1>Old Password dismatch<br>Redirecting...</h1>";
        header("refresh:4;url=../Setting");
        mysqli_close($con);
        exit;
    }
?>