<?php

    if(!isset($_POST["user_name"]) || !isset($_POST["user_ps"])){
        echo "error";
        exit;
    }
    $username = $_POST["user_name"];
    $userps = $_POST["user_ps"];
    include "database.php";

    $q1 = "SELECT * FROM basic_data";
    $get_creditional = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_creditional)){
        $registered_email = "owner_".$r["email_id"];
        $registered_password = base64_decode($r["password"]);
    }
    
    if($registered_email == $username){
        if($registered_password == $userps){
            date_default_timezone_set('Asia/Kolkata');
            $time = date("dmyhis");
            $newtime = date("smyhid");
            $token = "DailyBuyMart".$newtime."SL_VU".$time."oiqeqwOQSIWJ";  // SL_VU = Successfully login _ verified user
            $cookie_name = "dailybuymartpannel";
            $cookie_content = $token;
            if(setcookie($cookie_name,$cookie_content,time()+3600*24*3,"/")){
                $q2 = "INSERT INTO token (token) VALUES ('$token')";
                if(mysqli_query($con,$q2)){
                    header( "refresh:0;url=../Pannel-Home"); 
                }else{
                    echo "<h1>Unexpected Error! Try again<br>Redirecting....</h1>";
                    header( "refresh:4;url=../Login");     
                }
            }else{
                echo "<h1>Unexpected Error!! Try again<br>Redirecting....</h1>";
                header( "refresh:4;url=../Login"); 
            }
        }else{
            echo "<h1>Incorrect Password! Try again<br>Redirecting....</h1>";
            header( "refresh:4;url=../Login"); 
        }
    }else{
        echo "<h1>Incorrect Username! Try again<br>Redirecting....</h1>";
            header( "refresh:4;url=../Login");
    }
    mysqli_close($con);
?>