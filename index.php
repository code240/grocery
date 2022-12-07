<?php
    include "backend/database.php";
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








    $q1 = "SELECT * FROM basic_data";
    $q2 = "SELECT * From product WHERE pin = '1'"; 
    $get_basic = mysqli_query($con,$q1);
    while($r = mysqli_fetch_array($get_basic)){
        $shopName = $r["shop_name"];
        $ShortAddress = $r["short_address"];
        $ShopAdrress = $r["shop_address"];
        $mobile = $r["mobile"];
        $email = $r["email_id"];
        $map = $r["map_url"];
        $embed_map = $r["embed_map"];
        $upto = $r["upto_off"];

    }
    $get_product = mysqli_query($con,$q2);
    $products_count = mysqli_num_rows($get_product);
    if($products_count>0){
        $i = 0;
        while($r=mysqli_fetch_array($get_product)){
            $item_name[$i] = $r["item_name"];
            $brand_name[$i] = $r["brand"];
            $rating[$i] = $r["rating"];
            $product_id[$i] = $r["product_id"];
            $mrp[$i] = $r["mrp"];
            $selling_price[$i] = $r["selling_price"];
            $discount[$i] = $r["discount"];
            $quantity[$i] = $r["quantity"];
            $product_code[$i] = $r["product_code"];
            $cats[$i] = $r["cats"];
            $offers[$i] = $r["offers"];
            $offers_array = explode(",",$offers[$i]);
            $offer_len = count($offers_array);
            $offer = $offers_array[$offer_len-2];
            $q3 = "SELECT * FROM offer WHERE offer_code = '$offer'";
            $get_offers = mysqli_query($con,$q3);
            while($s = mysqli_fetch_array($get_offers)){
                $offername[$i] = $s["offer_name"];
            }
            $pc = $product_id[$i];
            $q4 = "SELECT * FROM media WHERE product_id = '$pc' AND active_image = '1'";
            $get_product_img = mysqli_query($con,$q4);
            $image_count = mysqli_num_rows($get_product_img);
            if($image_count==0){
                $main_image[$i] = "no_image.jpg";
            }else{
                while($t = mysqli_fetch_array($get_product_img)){
                    $main_image[$i] = $t["image_name"];
                }
            }
            
            $i++;
        }
    }




    // If category exist
    $cat_array = [
                    ["Biscuits & Cookies","biscuit and Cookies","biscuits and Cookie","biscuit & Cookies","biscuits & Cookie","Biscuits","Cookies","Biscuit","Cookie","Cookies & Biscuits","Cookies and Biscuits"],
                    ["Daily beverages","Daily beverage","beverages","beverage","Daily","Energy Drinks"],
                    ["Cleaning & Household","Cleaning","Household","Cleaning and Household","Household & Cleaning","Household and Cleaning"],
                    ["Beauty & Hygine","Beauty and Hygine","Hygine & Beauty","Hygine and Beauty","Beauty","Hygine"],
                    ["Fresh Vegetables","Fresh Vegetable","Vegetables","Vegetable","Vegetables Fresh","Vegetable Fresh","Fresh"]
                ];
    for($m = 0; $m < count($cat_array); $m++){
        $new_arr = $cat_array[$m];
        for($n = 0; $n < count($new_arr); $n++){
            $q5 = "SELECT * FROM category WHERE cat_name = '$new_arr[$n]'";
            // echo "<script>alert(`$q5`);</script>";
            $get_reserve_cat = mysqli_query($con,$q5);
            $total_reserve_cat = mysqli_num_rows($get_reserve_cat);
            // echo "<script>alert(`$total_reserve_cat`);</script>";
            if($total_reserve_cat==0){
                $reserve_link[$m] = "Shop";
            }
            if($total_reserve_cat>=1){
                while($r = mysqli_fetch_array($get_reserve_cat)){
                    $reserve_link[$m] = "Shop?x=".$r["id"];
                    break;
                }
                break;
            }

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
    <meta name="description" content="Daily buy mart provides you the best deals on all groceries products. Here you can find new offers daily. All groceries available here!">
    <meta name="keywords" content="DailyBuyMart,Groceries,Shop online">
    <meta name="author" content="Vipin Rao">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="media/favicon.png" type="image/x-icon">
    <script src="js/home.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <title>Home - Daily Buy Mart</title>
</head>
<body>
    <!-- Top location div -->
    <top class="top" id="top">
        <span class="top-text">
            Kindly visit our store to purchase &nbsp;
            <i class="fas fa-map-marker-alt"></i> 
                <?php echo $ShortAddress; ?>
            <a href="<?php echo $map; ?>" target="_blank" style="text-decoration:none;">
                <button class="btn btn-location-top">
                    location
                </button>
            </a>
        </span>
        <span class="cut-option-top" onclick="hideTop();">
            <i class="fas fa-times"></i>
        </span>
    </top>
    <!-- daily buy mart Header -->
    <header class="dbm-wrapper" id="main-header">
        <div class="dbm-logo-wrapper">
            <div class="dbm-logo-wrap">
                <img src="media/logo-png.png" alt="Daily-Buy-Mart-Logo" class="logo-img"  onclick="window.location.assign('Home')"/>
            </div>
            <div class="icon-line-bar" id="bars">
                <span class="bars-icon"> 
                    <i class="fas fa-bars" onclick="show_nav()" id="ShowBar"></i>
                    <i class="fas fa-times" onclick="hide_nav()" id="CutBar"></i>
                </span>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="dbm-side-header" id="side-inside-mainHeader">
            <div class="dbm-sideTopHeader-wrapper">
                <span class="contact-inside-sideTopheader">
                    <i class="fas fa-phone-alt"></i> &nbsp; <?php echo $mobile; ?>
                </span>
                <span class="location-inside-sideTopheader">
                    <i class="fas fa-map-marker-alt"></i> &nbsp; <?php echo $ShopAdrress; ?>
                </span>
            </div>
            <div class="sideTop-buttons" id="TopBtns">
                <a href="Home" style="text-decoration: none;"><button class="btn btn-topOptions btn-top-1">Home</button></a>
                <a href="Shop" style="text-decoration: none;"><button class="btn btn-topOptions btn-top-2">Shop</button></a>
                <?php
                if($off_num>0){
                    for($f=$off_num-1;$f>=0;$f--){
                        echo<<<offersNew
                        <a href="Shop?y=$off_id[$f]">
                            <button class="btn btn-topOptions btn-top-2">$offer_namex[$f]</button>
                        </a>
offersNew;
                        if($f==$off_num-1){
                            break;
                        }
                    }
                }
            ?>
                <a href="#category" style="text-decoration: none;"><button class="btn btn-topOptions btn-top-4">Categories</button></a>
                <a href="Contact" style="text-decoration: none;"><button class="btn btn-topOptions btn-top-6">Contact</button></a>
                <a href="About" style="text-decoration: none;"><button class="btn btn-topOptions btn-top-7">About</button></a>
                <a href="<?php echo $map; ?>" target="_blank" style="text-decoration: none;"><button class="btn btn-topOptions btn-top-8">Track us</button></a>

            </div>
            
        </div>
        <div style="clear: both;"></div>
    </header>
<!-- Front wrapper -->
    <div class="front-wrapper">
        <!-- <div class="text-front-wrapper">
        </div> -->
        <div class="text-front-wrap">
            <h2 class="front-font-1"> 
                For all grocery products get upto
            </h2>
            <div class="offDiv-front">
                <span class="offNumber-text-front">
                    <?php echo $upto; ?>%
                </span>
                <span class="offWord-text-front">
                    Off
                </span>
            </div>
        </div>
        <div class="backgound-imageFront-wrapper">
            <div class="top-insideBackground-front">
                <span class="offer-line">
                    Get the lowest <span class="c-red">Price</span> on groceries.  
                </span>
            </div>
            <div class="middle-insideBackground-front">
                
            </div>
            <div class="bottom-insideBackground-front">
                <span class="bottom-address-contact">
                    Contact Us : 98948948XX
                </span>
                <span class="bottom-address">
                    Address : Chandni Chowk, Shop no: 834 (New Delhi)
                </span>
            </div>
        </div>
        
        <div style="clear: both;"></div>
    </div>
<!-- Best seller product -->
    <div class="best-seller-div" id="topOffers">
        <h3 class="best-seller-heading">
            Best seller product
        </h3>
        <div class="cardOfcard-wrapper">
<?php
if($products_count>0){
for($j=$i-1;$j>=0;$j--){
echo<<<card
            <!-- card start from here 1 -->
            <a href="Product?display=$product_id[$j]" style="color:#000;">
                <div class="card-wrapper">
                    <div class="offpercent-card-wrapper">
                        <span class="offpercent-card">
                            $discount[$j]% off
                        </span>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="card-image-wrapper">
                        <img src="./media/miniProducts/$main_image[$j]" alt="dbm-Product" class="product-png">  
                    </div>
                    <span class="brandname-insidecard text-truncate">$brand_name[$j]</span>
                    <h4 class="product-name text-truncate">
                        $item_name[$j]
                    </h4>
                    <span class="star-ratting-design">
                        $rating[$j]
                        <span class="material-icons star-font">
                            star
                        </span>
                    </span>
                    <span class="rating-text-insideCard">
                        $rating[$j] rating
                    </span>
                    <span class="quantity-rate  text-truncate">
                        $quantity[$j] - Rs $selling_price[$j]
                    </span>
                    <div class="mrp-wrapper text-truncate">
                        <span class="newPrice-text">
                            Rs $selling_price[$j]
                        </span>
                        <span class="mrp-text">
                            MRP
                        </span>
                        <span class="mrpRs-text">
                            <del>Rs $mrp[$j]</del>
                        </span>
                    </div>
                    <span class="offer-type text-truncate">
                        &middot; $offername[$j]
                    </span>
                    <div class="card-button-wrappers">
                        <a>
                            <button class="btn-card-visit"  onclick="visit_store();" id="lap-btn">Visit Store</button>
                        </a>
                        <a>
                            <button class="btn-card-visit" onclick="visit_store();" id="mobi-btn"><i class="fas fa-store-alt"></i></button>
                        </a>
                        <button class="btn-card btn-card-call" onclick="call_us();"><i class="fas fa-phone-alt"></i></button>
                        <button class="btn-card btn-card-message" onclick="chat('$item_name[$j]');"><i class="far fa-comment-dots"></i></button>
                    </div>
                </div>
            </a>
            <!-- card ends up here 1 -->
card;
if($j==$i-4){
    break;
}
}
}else{
echo<<<nodata
    <h6 style="text-align:center;margin:0 auto;">No Data Found</h6>
nodata;
}
?>
            <div style="clear: both;"></div>
        </div>
        <div class="viewall-btn-wrapper">
            <a href="Shop">
                <button class="btn btn-viewall">Show more</button><br>
            </a>
            <!-- <div style="clear: both;"></div> -->
        </div>
    </div>
    <hr class="line"/>
    <div class="dailyStaples-wrapper" id="product">
        <h4 class="dailyStaple-heading">
            Get your daily requirements
        </h4>
        <div class="dailyStaple-child-wrapper">
            <div class="dailyStaple-child">
                <img src="./media/daily1.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily15.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily2.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily14.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily3.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily13.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily4.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily12.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily5.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily11.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily6.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily10.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily7.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child">
                <img src="./media/daily9.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
            <div class="dailyStaple-child" id="last-item">
                <img src="./media/daily8.jpg" alt="daily-staples" class="dailyStaple-img">
            </div>
        </div>
        <div class="viewall-btn-wrapper">
            <a href="Shop">
                <button class="btn btn-viewall">View all products</button>
            </a>
            <div style="clear: both;"></div>
        </div>
    </div>
    <hr class="line"/>
    <div class="shop-category-wrapper" id="category">
        <h1 class="shopByCategory">
            Shop By Category
        </h1>
        <div class="category-wrapper">
            <div class="category-left">
                <div class="main-item1">
                    <img src="./media/category6.jpg" alt="dbm-category" class="category-item-img" onclick="window.location.assign('<?php echo $reserve_link[0]; ?>')">
                </div>
            </div>
            <div class="category-right">
                <div class="right-top">
                    <div class="right-top-1">
                        <img src="./media/category2.jpg" alt="dbm-category" class="category-item-img" onclick="window.location.assign('<?php echo $reserve_link[1]; ?>')">
                    </div>
                    <div class="right-top-2">
                        <img src="./media/category1.jpg" alt="dbm-category" class="category-item-img" onclick="window.location.assign('<?php echo $reserve_link[2]; ?>')">
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="right-bottom">
                    <div class="right-bottom-1">
                        <img src="./media/category5.jpg" alt="dbm-category" class="category-item-img" onclick="window.location.assign('<?php echo $reserve_link[3]; ?>')">
                    </div>
                    <div class="right-bottom-2">
                        <img src="./media/category4.jpg" alt="dbm-category" class="category-item-img" onclick="window.location.assign('<?php echo $reserve_link[4]; ?>')">
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>

    <div class="whyChooseUs-wrapper" id="why">
        <h5 class="whyChooseUs-heading">
            Why choose Daily Buy Mart?
        </h5>
        <div class="whyChooseUs-Content-wrapper">
            <div class="whyChooseLeft"> 
                <h5 class="feature-heading">
                    <span class="dot-font">
                        <i class="fas fa-dot-circle"></i> &nbsp;
                    </span>
                    Get the lowest price everyday.
                </h5>
                <span class="feature-about">
                    We believe in offering the best of every item at a low price daily.
                </span>
                <h5 class="feature-heading">
                    <span class="dot-font">
                        <i class="fas fa-dot-circle"></i> &nbsp;
                    </span>
                    Hygine first is out motto.
                </h5>
                <span class="feature-about">
                    All standard safety measures are taken care as per the protocol.
                </span>
                <h5 class="feature-heading">
                    <span class="dot-font">
                        <i class="fas fa-dot-circle"></i> &nbsp;
                    </span>
                    Always trying to offer you the better service.
                </h5>
                <span class="feature-about">
                    Exclusive checkout counters for elderly people and women.
                </span>
                
            </div>
            <div class="whyChooseRight">
                <h5 class="feature-heading">
                    <span class="dot-font">
                        <i class="fas fa-dot-circle"></i> &nbsp;
                    </span>
                    Get the fresh groceries item everyday.
                </h5>
                <span class="feature-about">
                    Get access to the freshest products everyday.
                </span>
                <h5 class="feature-heading">
                    <span class="dot-font">
                        <i class="fas fa-dot-circle"></i> &nbsp;
                    </span>
                    We provide you all quality products.
                </h5>
                <span class="feature-about">
                    Get all items in multiple brands and options.
                </span>
                <h5 class="feature-heading">
                    <span class="dot-font">
                        <i class="fas fa-dot-circle"></i> &nbsp;
                    </span>
                    Widest product range. 
                </h5>
                <span class="feature-about">
                    Here you will find all your essentials in one place.
                </span>
                
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div class="ContactUs-wrapper" id="contact">
        <h4 class="contactUs-Heading">Contact us</h4>
        <div class="contact-source-wrapper">
            <div class="contact-source-card">
                <div class="contact-source-image-wrap">
                    <img src="media/call.png" alt="contact-dbm" class="contactSource-img">
                </div>
                <h6 class="callus-Contact">
                    Call us on
                </h6>
                <span class="callus-number" onclick="window.location.assign('tel:<?php echo $mobile; ?>')">
                    +91 <?php echo $mobile; ?>
                </span>
            </div>
            <div class="contact-source-card">
                <div class="contact-source-image-wrap">
                    <img src="media/gmail.png" alt="contact-dbm" class="contactSource-img">
                </div>
                <h6 class="callus-Contact">
                    Mail us at
                </h6>
                <span class="callus-number" onclick="window.location.assign('mailto:<?php echo $email; ?>')">
                    <?php echo $email; ?>
                </span>
            </div>
            <div class="contact-source-card" onclick="window.location.assign('<?php echo $map; ?>');">
                <div class="contact-source-image-wrap">
                    <img src="media/store2.png" alt="contact-dbm" class="contactSource-img">
                </div>
                <h6 class="callus-Contact">
                    Visit Shop
                </h6>
                <span class="callus-number">
                    <?php echo $ShopAdrress; ?>
                </span>
            </div>
        </div>
        <form action="backend/save_message.php" method="post" name="contact" onsubmit="return validation()">
            <div class="message-form-wrapper">
                <div class="name-email-wrapper">
                    <div class="name-email-left">
                        <label for="name-inp" class="label-name">Name:</label>
                        <input type="text" name="name" autocomplete="off" required id="name-inp" class="input-form input-name" placeholder="Your name">
                    </div>
                    <div class="name-email-right">
                        <label for="email-inp" class="label-name">Email:</label>
                        <input type="email" name="email" autocomplete="off" required id="email-inp" class="input-form input-name" placeholder="Email address">
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="for-subject-wrapper">
                    <label for="sub-inp" class="label-name">Subject:</label>
                    <input type="text" name="subject" autocomplete="off" required id="sub-inp" class="input-form input-name" placeholder="Subject">
                </div>
                <div class="for-message-wrapper">
                    <label for="msg" class="label-name">Message:</label>
                    <textarea name="message" id="msg" required placeholder="Type your message/Query" class="input-message"></textarea>
                    <input type="submit" value="Send" class="btn btn-submit">
                </div>
            </form>
        </div>
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
                <!-- <a href="<?php echo $map; ?>" target="_blank">
                    <span class="footer-part-1-item">Track us</span>
                </a><br/> -->
                <a href="Pannel" target="_blank">
                    <span class="footer-part-1-item">Admin</span>
                </a><br/>
            </div>
            <div class="footer-part-1">
                <h6 class="footer-heading">
                    Redirects
                </h6>
                <a href="#top">
                    <span class="footer-part-1-item">Back To Top</span>
                </a><br/>
                <a href="#product">
                    <span class="footer-part-1-item">Product</span>
                </a><br/>
                <a href="#why">
                    <span class="footer-part-1-item">Why Choose us</span>
                </a><br/>
                <a href="#category">
                    <span class="footer-part-1-item">Categories</span>
                </a><br/>
                <span class="footer-part-1-item" onclick="message_us()">Message us</span><br/>
                <a href="#contact">
                    <span class="footer-part-1-item">Contact Us</span>
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



    <div class="nav-mobi" id="mobiNav">        
        <a href="Home">
            <span class="mobiNav-icons mi-1">Home</span>
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
            <span class="mobiNav-icons">Contact Us</span>
        </a>
        <a href="About">
            <span class="mobiNav-icons">About us</span>
        </a>
        <a href="<?php echo $map; ?>" target="_blank">
            <span class="mobiNav-icons btn-track-mi">Track us</span>
        </a>

    </div>





    
    <div class="for-chat-wrapper" id="chatroom">
        <div class="message-form-wrapper chat-inner-wrapper">
            <form action="" method="post" id="ajaxForm">
                <h6 class="ask-chat" id="chat-heading">Ask any question / query related to this product : </h6>
                <div class="name-email-wrapper">
                    <div class="name-email-left">
                        <label for="name-inp2" class="label-name">Name:</label>
                        <input type="text" name="name" autocomplete="off" required id="name-inp2" class="input-form input-name" placeholder="Your name">
                    </div>
                    <div class="name-email-right">
                        <label for="email-inp2" class="label-name">Email:</label>
                        <input type="email" name="email" autocomplete="off" required id="email-inp2" class="input-form input-name" placeholder="Email address">
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <!-- <div class="for-subject-wrapper"> -->
                    <!-- <label for="sub-inp" class="label-name">Subject:</label> -->
                    <input type="hidden" name="subject" autocomplete="off" required id="chat-subject2" class="input-form input-name" >
                <!-- </div> -->
                <div class="for-message-wrapper">
                    <label for="msg2" class="label-name">Message:</label>
                    <textarea name="message" id="msg2" placeholder="Type your message/Query" class="input-message"></textarea>
                    <input type="submit" value="Send" id="save" class="btn btn-submit">
                </div>
            </form>
            <button class="btn btn-danger" onclick="cancel_chat()">cancel</button>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $("#save").on("click",function(e){
                e.preventDefault();
                var name = $('#name-inp2').val();
                var email = $('#email-inp2').val();
                var subject = $('#chat-subject2').val();
                var msg = $('#msg2').val();
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
                            response = dataResult.slice(-3);
                            if(response=="yes"){
                                alert("Your message has been sent successfully.");
                                $("#ajaxForm").trigger("reset");
                                $("#chatroom").css("display","none");
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
                            response = dataResult.slice(-3);
                            if(response=="yes"){
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





    

<div class="for-chat-wrapper for-location-wrapper" id="locationRoom">
        <div class="location-main-wrapper">
            <h6 class="visit-text">Please visit our store to buy : <span class="storename-text"> <?php echo $shopName; ?></span></h6>
            <iframe src=" <?php echo $embed_map; ?>" frameborder="0" class="iframe-fixed"></iframe>
            <h6 class="shop-address-fixed">Address : <?php echo $ShopAdrress; ?></h6>
            <a href=" <?php echo $map; ?>" target="_black">
                <button class="btn btn-primary btn-fixed-location">Location</button>
            </a>
        </div>
        <span class="cut-sign-for-location" onclick="cut_location()">
        <i class="fas fa-times"></i>
        </span>
    </div>

    <div class="for-chat-wrapper" id="callroom">
        <div class="call-us-wrapper">
            <div class="call-logo-fixed">
                
            </div>
            <h6 class="call-heading">
                You can directly call us on our contact number during the working hour (8AM to 6PM).
            </h6>
            <h6 class="our-contact">
                (+91) <?php echo $mobile; ?>
            </h6>
            <a href="tel:<?php echo $mobile; ?>">
                <button class="btn btn-primary btn-call-us-fixed">Call Us</button>
            </a>
            <span class="cut-call-div">
                <i class="fas fa-times" onclick="hide_call_us()"></i>
            </span>
        </div>
    </div>

</body>
</html>
<?php
    mysqli_close($con);
?>