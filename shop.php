<?php
    include "backend/database.php";
    include "backend/basic.php";
    error_reporting(0);

    $search_for = "All items";

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
        $offer_name[$s] = $r["offer_name"];
        $off_id[$s] = $r["id"];
        $off_code[$s] = $r["offer_code"];
        $s++;
        }
    }



    if(isset($_GET["x"])){
        error_reporting(0);
        $x = $_GET["x"];
        $ccq = "SELECT cat_code,cat_name FROM category WHERE id = $x"; // Category Code Query : ccq
        $get_ccq = mysqli_query($con,$ccq);
        $ccq_row = mysqli_num_rows($get_ccq);
        if($ccq_row==0 || $ccq_row>1){
            echo "<script>window.location.assign('Shop');</script>";
            exit;
        }
        while($r=mysqli_fetch_array($get_ccq)){
            $catCode = $r["cat_code"];
            $catName = $r["cat_name"];
        }
        $search_for = $catName;
        $q = "SELECT * FROM product";
        $get_products = mysqli_query($con,$q);
        $products_count = mysqli_num_rows($get_products);
        if($products_count>0){
            $i=0;
            while($r = mysqli_fetch_array($get_products)){
                $cats[$i] = $r["cats"];
                $explode_cat = explode(",",$cats[$i]);
                for($e=count($explode_cat)-2;$e>=0;$e--){
                    if($explode_cat[$e]==$catCode){
                        $item_name[$i] = $r["item_name"];
                        $brand_name[$i] = $r["brand"];
                        $rating[$i] = $r["rating"];
                        $product_id[$i] = $r["product_id"];
                        $mrp[$i] = $r["mrp"];
                        $selling_price[$i] = $r["selling_price"];
                        $discount[$i] = $r["discount"];
                        $quantity[$i] = $r["quantity"];
                        $product_code[$i] = $r["product_code"];
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
                
            }
        }

    }else if(isset($_GET["y"])){

        error_reporting(0);
        $y = $_GET["y"];
        $ocq = "SELECT offer_code,offer_name FROM offer WHERE id = $y"; // Offer Code Query : ocq
        $get_ocq = mysqli_query($con,$ocq);
        $ocq_row = mysqli_num_rows($get_ocq);
        if($ocq_row==0 || $ocq_row>1){
            echo "<script>window.location.assign('Shop');</script>";
            exit;
        }
        while($r=mysqli_fetch_array($get_ocq)){
            $offCode = $r["offer_code"];
            $offName = $r["offer_name"];
        }
        $search_for = $offName;
        $q = "SELECT * FROM product";
        $get_products = mysqli_query($con,$q);
        $products_count = mysqli_num_rows($get_products);
        if($products_count>0){
            $i=0;
            while($r = mysqli_fetch_array($get_products)){
                $product_offer[$i] = $r["offers"];
                $explode_offers = explode(",",$product_offer[$i]);
                for($e=count($explode_offers)-2;$e>=0;$e--){
                    if($explode_offers[$e]==$offCode){
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
                
            }
        }
    }else{
        $q = "SELECT * FROM product";
        $get_products = mysqli_query($con,$q);
        $products_count = mysqli_num_rows($get_products);
        if($products_count>0){
            $i=0;
            while($r = mysqli_fetch_array($get_products)){
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
    <meta name="description" content="Shop online : Daily buy mart provides you the best deals on all groceries products. Here you can find new offers daily. All groceries available here!">
    <meta name="keywords" content="DailyBuyMart,Groceries,Shop online">
    <meta name="author" content="Vipin Rao">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="media/favicon.png" type="image/x-icon">
    <script src="js/home.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/shop.css">
    <title><?php echo $search_for; ?> - Shop - Daily Buy Mart</title>
</head>
<body>
    <header class="shop-header">
        <div class="logo-div">
            <img src="./media/logo-png.png" alt="Daily-Buy-Mart" class="logo-dbm" onclick="window.location.assign('Home')">
        </div>
        <div class="for-search">
            <select name="item" id="item" class="top-search">
                <option value="Special Offers"><?php echo $search_for; ?></option>
            </select>
        </div>
        <div class="btn-div-top">
            <button class="btn btn-home-top" onclick="window.location.assign('Home')">Home</button>
            <button class="btn btn-track-top" onclick="window.location.assign('About')">About</button>
            <a href="<?php echo $map; ?>" target="_blank">
                <button class="btn btn-track-top"><i class="fas fa-map-marked-alt"></i> Track us</button>
            </a>
            <button class="btn btn-track-top" id="catNavBars" onclick="catNav_Show()"><i class="fas fa-bars"></i></button>
            <button class="btn btn-track-top" id="catNavCut" onclick="catNav_Hide()"><i class="fas fa-times"></i></button>

        </div>
        <div style="clear: both;"></div>
    </header>
    <div class="category-shower" >
        <div class="inner-category-shower">
        <?php
                if($cat_num>0){
                    for($e=$cat_num-1;$e>=0;$e--){
                        echo<<<cats1
                        <a href="Shop?x=$cat_id[$e]">
                            <span class="category-options">$category_name[$e]</span>
                        </a>
cats1;
if($e==$cat_num-5){
    break;
}
                    }
                }
            ?>
        </div>
    </div>
    <div class="main-body" id="top">
        <nav class="nav-in-left" id="cat-nav">
            <span class="nav-heading" id="categories">Categories</span>
            <?php
                if($cat_num>0){
                    for($e=$cat_num-1;$e>=0;$e--){
                        echo<<<cats
                        <a href="Shop?x=$cat_id[$e]">
                            <span class="nav-item nav-item-1">$category_name[$e] &#8250;</span>
                        </a>
cats;
                    }
                }
            ?>
            <span class="nav-heading nav-offer-heading"  id="offers">Offers</span>
            <?php
                if($off_num>0){
                    for($f=$off_num-1;$f>=0;$f--){
                        echo<<<offers
                        <a href="Shop?y=$off_id[$f]">
                            <span class="nav-item nav-item-1">$offer_name[$f] &#8250;</span>
                        </a>
offers;
                    }
                }
            ?>
        </nav>
        <section class="content-section-right" id="product">
            <div class="top-in-section">
                <span class="section-heading">Showing results for : <span class="unique-font"> <?php echo $search_for; ?>.</span></span>
                <span class="total-result">Showing 0 – <?php echo $i; ?> of <?php echo $i; ?> results for "<?php echo $search_for; ?>"</span>
            </div>
            <!-- copy paste -->
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
                <span class="quantity-rate text-truncate">
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
}
}else{
echo<<<nodata
    <h6 style="text-align:center;margin:0 auto;">No Data Found</h6>
nodata;
}
?>
                <div style="clear: both;"></div>
            </div>

            <p class="no-more-results">No more results</p>
            <!-- copy paste over -->
        </section>
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
                            <span class="footer-part-1-item">$offer_name[$f]</span><br/>
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
                            <span class="footer-part-1-item">$offer_name[$f]</span><br/>
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
                <a href="#product">
                    <span class="footer-part-1-item">Product</span>
                </a><br/>
                <a href="#offers">
                    <span class="footer-part-1-item" onclick="handle_offer()">Offers</span>
                </a><br/>
                <a href="#categories">
                    <span class="footer-part-1-item" onclick="handle_offer()">Categories</span>
                </a><br/>
                <span class="footer-part-1-item" onclick="message_us()">Message us</span><br/>
                <a href="#top">
                    <span class="footer-part-1-item">Back To Top</span>
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
                    // alert(msg);
                    $.ajax({
                        url: "backend/save.php",
                        type: "POST",
                        data: {
                            name: name,
                            email: email,
                            subject: subject,
                            message: msg,				
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