<?php
if(isset($_COOKIE["dailybuymartpannel"])){
    include "backend/database.php";
    $token = $_COOKIE["dailybuymartpannel"];
    $q1 = "SELECT * FROM token WHERE token = '$token'";
    $get_entries = mysqli_query($con,$q1);
    $entries_count = mysqli_num_rows($get_entries);
    if($entries_count==1){
        session_start();
        $_SESSION["loginstatus"] = "1"; 
        header("refresh:0;url=backend/redirect_to_pannel.php");
    }else{
        setcookie("dailybuymartpannel","",time()-3600,"/");
    }
    mysqli_close($con);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font awsome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Login-DailyBuyMart</title>
    <link rel="shortcut icon" href="media/arroba.png" type="image/x-icon" />

</head>
<body>
    <div class="master">
        <div class="submaster-left">
            <div class="logo-wrap">
                <h1 class="brand-heading">
                    <b class="brand-m">D</b>aily<b class="brand-b">B</b>uy<b class="brand-b">M</b>art
                </h1>
            </div>
            <div class="about-text-wrap">
                <span class="mailbox-about">
                    <i class="fas fa-lock"></i> Only Admin can login to the pannel.
                    Get the fully access to the databases.
                </span> 
            </div>
        </div>
        <div class="submaster-right">
            <div class="login-master">
                <form action="backend/verify_user.php" name="login_form" method="POST" onsubmit="return validationLogin();">
                    <input type="text" name="user_name" required pattern=".{6,50}" title="6 to 50 characters" autocomplete="off" id="username" class="input-field" placeholder="Email Address">
                    <input type="password" name="user_ps" required pattern=".{6,50}" title="6 to 50 characters" autocomplete="off" id="ps" class="input-field i-2" placeholder="Password">
                    <input type="submit" value="Login" class="input-field input-submit i-3">
                </form>
                <span class="mailbox-login-text">
                    Daily Buy Mart-Login
                </span>
                <hr/>
                <a style="text-decoration: none;">
                    <button class="btn btn-create" disabled>Create New Account</button>
                </a>
            </div>
            <span class="connect-text">
                <b>Daily Buy Mart</b> Start Handling website
            </span>
        </div>
        <div style="clear: both;"></div>
    </div>


    

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
