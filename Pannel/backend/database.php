<?php
    $a = "localhost";
    $b = "root";
    $c = "";
    $d = "grocery";
    $con = mysqli_connect($a,$b,$c,$d);
    if(!$con){
        echo "<h1>Data Base Connection failed !! <br> Retry!!</h1>";
        exit;
    }
?>