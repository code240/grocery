<?php
    if(isset($_COOKIE["dailybuymartpannel"])){
        include "database.php";
        $token = $_COOKIE["dailybuymartpannel"];
        $q1 = "DELETE FROM token WHERE token = '$token'";
        if(mysqli_query($con,$q1)){
            header( "refresh:0;url=../Login");
            setcookie("dailybuymartpannel","",time()-3600,"/");
        }else{
            echo "<h1>Database response error!</h1>";
            header( "refresh:4;url=../Login");            
        }
        mysqli_close($con);
    }else{
        header( "refresh:0;url=../Login");
    }
?>