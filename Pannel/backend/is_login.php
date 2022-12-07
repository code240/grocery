<?php
    if(isset($_COOKIE["dailybuymartpannel"])){
        include "database.php";
        $token = $_COOKIE["dailybuymartpannel"];
        $q1 = "SELECT * FROM token WHERE token = '$token'";
        $get_entries = mysqli_query($con,$q1);
        $entries_count = mysqli_num_rows($get_entries);
        if($entries_count==1){
            setcookie("dailybuymartpannel",$token,time()+3600*24*3,"/");
        }else{
            setcookie("dailybuymartpannel","",time()-3600,"/");
            header( "refresh:0;url=Login");
            mysqli_close($con);
            exit;
        }
    }else{
        header( "refresh:0;url=Login");
        exit;
    }
?>