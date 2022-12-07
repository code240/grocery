<?php
    include "backend/is_login.php";
    include "backend/data_count.php";
    include "backend/database.php";
    
    $q1 = "SELECT * FROM msg ORDER BY id DESC;";
    $get_msg = mysqli_query($con,$q1);
    $i = 0;
    while($r = mysqli_fetch_assoc($get_msg)){
        $username[$i] = $r["user_name"];
        $useremail[$i] = $r["user_email"];
        $subject[$i] = $r["msg_subject"];
        $msg[$i] = $r["user_message"];
        if($i==300){
            break;
        }
        $i++;
    }

?>


<!-- Warning: Cannot use a scalar value as an array in C:\VIPIN\Xampp_new\htdocs\mart\Pannel\offer.php on line 15 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Font awsome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&style=outlined" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/Product.css">
    <link rel="stylesheet" href="css/offer.css">
    <link rel="stylesheet" href="css/message.css">
    <title>Pannel - DailyBuyMart</title>
</head>
<body>
    <header class="top-header"> 
        <h6 class="header-heading">
            Total Product : <span class="green"><?php echo $product_count_2; ?></span> | 
            Total Categories : <span class="green"><?php echo $cat_count_2; ?></span> | 
            Total Offers : <span class="green"><?php echo $offer_count_2; ?></span>
        </h6>
        <button class="btn btn-primary btn-add-new" onclick="window.location.assign('Add');">
            <i class="fas fa-plus-circle"></i> &nbsp; Add new product 
        </button>
        <button class="btn btn-primary bars-heading" id="show_bar" onclick="pannel_nav_show()">
            <i class="fas fa-bars"></i>
        </button>
        <button class="btn btn-danger bars-heading" id="cut_bar" onclick="pannel_nav_hide()">
            <i class="fa fa-times"></i>
        </button> 
        <div style="clear: both;"></div>
    </header>
    <nav class="side-nav" id="nav_pannel">
        <div class="logo-in-nav">
            <div class="main-logo-nav">
                <img src="../media/logo-w.png" alt="logo" class="dbm-logo">
            </div>
        </div>
        <a href="Pannel-Home">
            <span class="nav-btn nav-btn-1 "><i class="fas fa-shopping-basket"></i> &nbsp; Products</span>
        </a>
        <a href="Add">
            <span class="nav-btn"><i class="fas fa-plus-circle"></i>  &nbsp; Add Product</span>
        </a>
        <a href="Offer">
            <span class="nav-btn"><i class="fas fa-grin-beam"></i> &nbsp; Offers</span>
        </a>
        <a href="Category">
            <span class="nav-btn"><i class="fas fa-th"></i> &nbsp; Category</span>
        </a>
        <a href="Messages">
            <span class="nav-btn active"><i class="fas fa-comment-alt"></i> &nbsp; Messages</span>
        </a>
        <a href="Setting">
            <span class="nav-btn"><i class="fas fa-cog"></i> &nbsp; Setting</span>
        </a>

    </nav>
    <div class="main-body main-body-2">
        <div class="content-heading">
            <h1 class="heading">
                Manage Messages
            </h1>
        </div>
        <?php
            // for($j=0;$j<$i;$j++){
            //     echo $username[$j];
            //     break;
            // }
        ?>


            <div class="message_wrapper">
            <?php
            for($j=0;$j<$i;$j++){
            echo<<<msg
                <div class="message-card">
                    <span class="sendername">$username[$j]</span>
                    <span class="senderemail">$useremail[$j]</span>
                    <h6 class="subject">
                        <span class="subject-word">Subject :</span>
                        $subject[$j]
                    </h6>
                    <h4 class="user-message">
                        <span class="subject-word">Message :</span>
                        $msg[$j]
                    </h4>
                    <a href="mailto:$useremail[$j]">
                        <button class="btn btn-primary btn-reply">Reply via mail</button>
                    </a>
                    <div style="clear:both;"></div>
                </div>
msg;
                }
                ?>
            <div style="clear:both;"></div>
        </div>

    </div>

</body>
</html>
<?php
    mysqli_close($con);
?>