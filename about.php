<?php
    include "backend/database.php";
    include "backend/basic.php";
    error_reporting(0);
    

    
    $cq = "SELECT * FROM category";
    $get_cat = mysqli_query($con,$cq);
    $cat_num = mysqli_num_rows($get_cat);
    if($cat_num>0){
        $p=0;
        while($r=mysqli_fetch_array($get_cat)){
        $category_name[$p] = $r["cat_name"];
        $cat_id[$p] = $r["id"];
        $cat_code[$p] = $r["cat_code"];
        $p++;
        }
    }

    $oq = "SELECT * FROM offer";
    $get_off = mysqli_query($con,$oq);
    $off_num = mysqli_num_rows($get_off);
    if($off_num>0){
        $s=0;
        while($r=mysqli_fetch_array($get_off)){
        $offer_namex[$s] = $r["offer_name"];
        $off_id[$s] = $r["id"];
        $off_code[$s] = $r["offer_code"];
        $s++;
        }
    }







?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="description" content="About : Daily buy mart provides you the best deals on all groceries products. Here you can find new offers daily. All groceries available here!">
    <meta name="keywords" content="DailyBuyMart,Groceries,Shop online">
    <meta name="author" content="Vipin Rao">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="media/favicon.png" type="image/x-icon">
    <script src="js/home.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/about.css">
    <title>About - Daily Buy Mart</title>
</head>
<body>
    <header class="contact-header" id="top">
        <div class="for-logo-contact">
            <img src="./media/logo-png.png" alt="logo-daily-buy-mart" class="logo-contactpage" onclick="window.location.assign('Home')">
        </div>
        <div class="div-for-btn-header">
            <a href="Home">
                <button class="btn btn-contact-header">Home</button>
            </a>
            <a href="Shop">
                <button class="btn btn-contact-header">Shop</button>
            </a>
            <a href="Contact">
                <button class="btn btn-contact-header active">Contact</button>
            </a>
            <a href="About">
                <button class="btn btn-contact-header">About</button>
            </a>
            <a href="<?php echo $map; ?>" target="_blank">
                <button class="btn btn-contact-header">Track us</button>                
            </a>
        </div>
        <div class="for-bars-div" id="bars-div">
            <span class="for-bars-contact" id="bars-contact" onclick="showContactNav()">
                <i class="fas fa-bars"></i>
            </span>
            <span class="for-bars-contact" id="cuts-contact" onclick="hideContactNav()">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <div style="clear: both;"></div>
    </header>
    <div class="front-in-contact">
        <h1 class="h1-tag">
            Visit our shop for more offers
        </h1>
        <p class="para-inContact">
            DailyBuyMart provides you good quality Grocery items at affordable prices. Visit our shop to buy : <?php echo $ShopAdrress; ?>
        </p>
    </div>
    <div class="contact-main">
        <div class="left-main-contact">
            <div class="top-in-left-main">
                <div class="left-for-logo-in-LeftMain">
                    <div class="call-logo-wrapper">
                        <img src="./media/call.png" alt="Call-icon" class="call-logo">
                    </div>
                </div>
                <div class="right-for-logo-in-LeftMain">
                    <h6 class="call-us-heading">
                        Call us directly at -
                    </h6>
                    <span class="call-number" onclick="window.location.assign('tel:<?php echo $mobile; ?>')">
                        (+91) <?php echo $mobile; ?>
                    </span>
                </div>
            </div>
            <div class="bottom-in-left-main">
                <div class="left-for-logo-in-LeftMain">
                    <div class="call-logo-wrapper">
                        <img src="./media/gmail.png" alt="Call-icon" class="call-logo">
                    </div>
                </div>
                <div class="right-for-logo-in-LeftMain">
                    <h6 class="call-us-heading">
                        Send us mail at -
                    </h6>
                    <span class="call-number" onclick="window.location.assign('mailto:<?php echo $email; ?>')">
                        <?php echo $email; ?>
                    </span>
                    <span class="location-link">
                        
                    </span>
                </div>
            </div>
            <div class="bottom-in-left-main2" id="location">
                <iframe src="<?php echo $embed_map; ?>" class="location-frame"></iframe>
            </div>
        </div>
        <div class="right-main-contact" id="about">
            <h2 class="about-heading">About us</h2>
            <span class="about-page-text">
                DailyBuyMart is a shop which gives you great discounts on all grocery products.
                On this website you can see all the products on which there is an offer.
                If you want to buy anything then you can come directly to our shop. Our shop is here :
                <span class="green-clr"><?php echo $ShopAdrress; ?></span>.<br>
                We have a widest product range, Here you will find all types of grocery items.
                You will get all the things used in the house at one place.<br>
                You can call us anytime on our contact number 
                <span class="green-clr"><?php echo $mobile; ?></span> or you can 
                also send the email us on our email address <span class="green-clr">
                <?php echo $email; ?></span><br>
                At present there is no facility like home delivery. 
                If you want to buy goods then you have to come to the shop
            </span>
        </div>
        <div style="clear: both;"></div>
    </div>



    <footer class="footer">
        <!-- <hr class="line"/> -->
        <div class="for-footer-branding-wrapper">
            <div class="for-logo-footer">
                <img src="media/logo-png.png" alt="logo-dbm" class="footer-logo" onclick="window.location.assign('Home')">
            </div>
            <div class="for-text-footer">
                <span class="footer-text">
                    Daily Buy Mart - 2021
                </span>
            </div>
        </div>
        <div class="footer-wrapper">
            <div class="footer-part-1">
                <h6 class="footer-heading">
                    DailyBuyMart
                </h6>
                <?php
                if($cat_num>0){
                    for($e=$cat_num-1;$e>=0;$e--){
                        echo<<<cats
                        <a href="Shop?x=$cat_id[$e]">
                            <span class="footer-part-1-item">$category_name[$e] </span><br/>
                        </a>
cats;
                        if($e==$cat_num-4){
                            break;
                        }
                    }
                }
            
                if($off_num>0){
                    for($f=$off_num-1;$f>=0;$f--){
                        echo<<<offers
                        <a href="Shop?y=$off_id[$f]">
                            <span class="footer-part-1-item">$offer_namex[$f]</span><br/>
                        </a>
offers;
                        if($f==$off_num-3){
                            break;
                        }
                    }
                }
            ?>
              
            </div>
            <div class="footer-part-1 footer-part-2">
                <h6 class="footer-heading">
                    Quick links
                </h6>
                <a href="Home">
                    <span class="footer-part-1-item">Home</span>
                </a><br/>
                <a href="Shop">
                    <span class="footer-part-1-item">Shop</span>
                </a><br/>
            <?php
                if($off_num>0){
                    for($f=$off_num-1;$f>=0;$f--){
                        echo<<<offersNew
                        <a href="Shop?y=$off_id[$f]">
                            <span class="footer-part-1-item">$offer_namex[$f]</span><br/>
                        </a>
offersNew;
                        if($f==$off_num-1){
                            break;
                        }
                    }
                }
            ?>
                <a href="Contact">
                    <span class="footer-part-1-item">Contact</span>
                </a><br/>
                <a href="About">
                    <span class="footer-part-1-item">About us</span>
                </a><br/>
                <a href="<?php echo $map; ?>" target="_blank">
                    <span class="footer-part-1-item">Track us</span>
                </a><br/>
            </div>
            <div class="footer-part-1">
                <h6 class="footer-heading">
                    Redirects
                </h6>
                <a href="#top">
                    <span class="footer-part-1-item">Back To Top</span>
                </a><br/>
                <a href="tel:<?php echo $mobile; ?>">
                    <span class="footer-part-1-item">Contact</span>
                </a><br/>
                <a href="mailto:<?php echo $email; ?>">
                    <span class="footer-part-1-item">Mail us</span>
                </a><br/>
                <a href="#location">
                    <span class="footer-part-1-item">Location</span>
                </a><br/>
                <span class="footer-part-1-item" onclick="message_us()">Message us</span><br/>
                <a href="#about">
                    <span class="footer-part-1-item">About</span>
                </a><br/>
            </div>
            <div class="footer-part-1">
                <h6 class="footer-heading">
                    Contact us here
                </h6>
                <div class="footer-contact-wrapper">
                    <div class="footer-icon-wrap"> 
                        <img src="media/telephone.png" alt="connect-with-dbm" class="footer-icon" onclick="window.location.assign('tel:<?php echo $mobile; ?>')">
                    </div>
                    <div class="footer-icon-wrap">
                        <img src="media/placeholder.png" alt="connect-with-dbm" class="footer-icon" onclick="window.location.assign('<?php echo $map; ?>');">
                    </div>
                    <div class="footer-icon-wrap">
                        <img src="media/at-sign.png" alt="connect-with-dbm" class="footer-icon"  onclick="window.location.assign('mailto:<?php echo $email; ?>')">
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
    </footer>

    <div class="last">
        &#169; Daily Buy Mart - 2021 &#160; All right reserved
    </div>

    <div class="nav-mobi" id="mobiNav2">
        <a href="Home">
            <span class="mobiNav-icons">Home</span>
        </a>
        <a href="Shop">
            <span class="mobiNav-icons">Shop</span>
        </a>
        <?php
                if($off_num>0){
                    for($f=$off_num-1;$f>=0;$f--){
                        echo<<<offersNew
                        <a href="Shop?y=$off_id[$f]">
                            <span class="mobiNav-icons">$offer_namex[$f]</span>
                        </a>
offersNew;
                        if($f==$off_num-2){
                            break;
                        }
                    }
                }
            ?>
        <a href="Contact">
            <span class="mobiNav-icons">Contact</span>
        </a>
        <a href="About">
            <span class="mobiNav-icons">About</span>
        </a>
        <a href="<?php echo $map; ?>" target="_blank">
            <span class="mobiNav-icons btn-track-mi">Track us</span>
        </a>
       
    </div>



<div class="for-chat-wrapper" id="messageroom">
        <div class="message-form-wrapper chat-inner-wrapper">
            <form action="" method="post" id="ajaxForm2">
                <h6 class="ask-chat" id="chat-heading">Get in touch.  </h6>
                <div class="name-email-wrapper">
                    <div class="name-email-left">
                        <label for="name-inp3" class="label-name">Name:</label>
                        <input type="text" name="name" autocomplete="off" required id="name-inp3" class="input-form input-name" placeholder="Your name">
                    </div>
                    <div class="name-email-right">
                        <label for="email-inp3" class="label-name">Email:</label>
                        <input type="email" name="email" autocomplete="off" required id="email-inp3" class="input-form input-name" placeholder="Email address">
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="for-subject-wrapper">
                    <label for="chat-subject3" class="label-name">Subject:</label>
                    <input type="text" name="subject" autocomplete="off" required id="chat-subject3" class="input-form input-name" placeholder="Subject">
                </div>
                <div class="for-message-wrapper">
                    <label for="msg3" class="label-name">Message:</label>
                    <textarea name="message" id="msg3" placeholder="Type your message/Query" class="input-message"></textarea>
                    <input type="submit" value="Send" id="save3" class="btn btn-submit">
                </div>
            </form>
            <button class="btn btn-danger" onclick="cancel_msg()">cancel</button>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#save3").on("click",function(e){
                e.preventDefault();
                var name = $('#name-inp3').val();
                var email = $('#email-inp3').val();
                var subject = $('#chat-subject3').val();
                var msg = $('#msg3').val();
                if(name.trim()!="" && email.trim()!="" && subject.trim()!="" && msg.trim()!=""){
                    // alert(subject);
                    $.ajax({
                        url: "backend/save.php",
                        type: "POST",
                        data: {
                            name: name,
                            email: email,
                            subject: subject,
                            message: msg				
                        },
				        success: function(dataResult){
                            if(dataResult=="yes"){
                                alert("Your message has been sent successfully.");
                                $("#ajaxForm2").trigger("reset");
                                $("#messageroom").css("display","none");
                            }else{
                                alert("Message Save error :" + dataResult);
                            }
                     }   
                    })

                }else{
                    alert('Please fill all the field !');
                }
            })
        })
    </script>






</body>
</html>

<?php
    mysqli_close($con);
?>