<?php
    $a = "localhost";
    $b = "root";
    $c = "";
    $d = "grocery";
    $con = mysqli_connect($a,$b,$c,$d);
if(!$con){
echo<<<FailedToConnect
        <h3>
            Something went wrong!<br>    
            Failed to connect with database<br>
        </h3>
FailedToConnect;
exit;
}
?>