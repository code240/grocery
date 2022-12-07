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




    if(isset($_GET["display"])){
        $product = $_GET["display"];
        $q = "SELECT * FROM product WHERE product_id = '$product'";
        $get_info = mysqli_query($con,$q);
        $product_count = mysqli_num_rows($get_info);
        // echo $product_count;
        if($product_count==0 || $product_count>1){
            header("location:Home");
            exit;
        }
        while($r = mysqli_fetch_array($get_info)){
            $product_name = $r["item_name"];
            $brand_name =  $r["brand"];
            $rating =  $r["rating"];
            $mrp =  $r["mrp"];
            $selling_price =  $r["selling_price"];
            $discount =  $r["discount"];
            $quantity =  $r["quantity"];
            $product_code =  $r["product_code"];
            
            $q3 = "SELECT * FROM product WHERE product_code = '$product_code'";
            $get_more_quantity = mysqli_query($con,$q3);
            // echo mysqli_num_rows($get_more_quantity);
            $x = 0;
            while($s=mysqli_fetch_array($get_more_quantity)){
                $more_mrp[$x] = $s["mrp"];
                $more_selling[$x] = $s["selling_price"];
                $more_quantity[$x] = $s["quantity"];
                $more_id[$x] = $s["product_id"];
                $x++;
            }

            $cats = $r["cats"];
            $explode_similar_cats = explode(",",$cats);


            $offers = $r["offers"];
            $explode_offer = explode(",",$offers);
            $z=0;
            for($e=count($explode_offer)-2;$e>=0;$e--){
                $q2 = "SELECT * FROM offer WHERE offer_code = '$explode_offer[$e]'";
                $get_offers = mysqli_query($con,$q2);
                while($r=mysqli_fetch_array($get_offers)){
                    $offer_name[$z] = $r["offer_name"];
                    $z++;
                }
            }
        }
        $q4 = "SELECT * FROM media WHERE product_id = '$product'";
        $get_media = mysqli_query($con,$q4);
        $other_image = 0;

        if(mysqli_num_rows($get_media)==0){
            $main_image = "no_image.jpg";
            $other_image = 0;
        }else{
            $j=0;$k=0;
            while($r = mysqli_fetch_array($get_media)){
                if($r["active_image"]=="1"){
                    $main_image = $r["image_name"];
                    $all_img[$k] = $r["image_name"];
                    $k++;
                }else{
                    $img[$j] = $r["image_name"];
                    $other_image=1;
                    $j++;
                    $all_img[$k] = $r["image_name"];
                    $k++;
                }
            }
        }

        $q5 = "SELECT * FROM specification WHERE product_id = '$product'";
        $get_specification = mysqli_query($con,$q5);
        $l=0;
        while($r = mysqli_fetch_array($get_specification)){
            $specification[$l] = $r["description"];
            $l++;
        }
        $q6 = "SELECT * FROM product WHERE ";
        for($ee=count($explode_similar_cats)-2;$ee>=0;$ee--){
            $q6 .= "(cats LIKE '%$explode_similar_cats[$ee]%')";
            if($ee!=0){
                $q6 .= " || ";
            }
        }
        // echo "<script>alert(`$q6`)</script>";    
        $get_similar_product = mysqli_query($con,$q6);
        $similar_count = mysqli_num_rows($get_similar_product);
        // echo "<script>alert(`$similar_count`)</script>";

        $ss=0;
        while($r = mysqli_fetch_array($get_similar_product)){
            if($r["product_id"]!=$product){
                $similar_product_name[$ss] = $r['item_name'];
                $similar_product_brandname[$ss] = $r['brand'];
                $similar_product_mrp[$ss] = $r['mrp'];
                $similar_product_id[$ss] = $r['product_id'];
                $similar_product_selling[$ss] = $r['selling_price'];
                $similar_product_discount[$ss] = $r['discount'];
                $similar_product_quantity[$ss] = $r['quantity'];
                $similar_product_productCode[$ss] = $r['product_code'];
                $similar_product_rating[$ss] = $r['rating'];
                $similar_product_offers[$ss] = $r['offers'];
                $similar_explode_offer = explode(",",$similar_product_offers[$ss]);
                $last_index = count($similar_explode_offer) - 2;
                $q7 = "SELECT offer_name FROM offer WHERE offer_code = '$similar_explode_offer[$last_index]'";
                $get_similar_offer_name = mysqli_query($con,$q7);
                while($s = mysqli_fetch_array($get_similar_offer_name)){
                    $similar_offer_name[$ss] = $s["offer_name"];
                }
                $q8 = "SELECT * FROM media WHERE product_id = '$similar_product_id[$ss]' AND active_image = '1'";
                $get_simi_imgs = mysqli_query($con,$q8);
                $get_simi_imgs_count = mysqli_num_rows($get_simi_imgs);
                if($get_simi_imgs_count==0){
                    $similar_product_img[$ss] = "no_image.jpg";
                }if($get_simi_imgs_count==1){
                    while($s = mysqli_fetch_array($get_simi_imgs)){
                        $similar_product_img[$ss]=$s["image_name"];
                    }
                }if($get_simi_imgs_count>1){
                    while($s = mysqli_fetch_array($get_simi_imgs)){
                        $similar_product_img[$ss]=$s["image_name"];
                        break;
                    }
                }
                $ss++;
            }
        }
    }else{
        header("location:Home");
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
    
    <meta name="description" content="Products : Daily buy mart provides you the best deals on all groceries products. Here you can find new offers daily. All groceries available here!">
    <meta name="keywords" content="DailyBuyMart,Groceries,Shop online">
    <meta name="author" content="Vipin Rao">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="media/favicon.png" type="image/x-icon">
    <script src="js/home.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/product.css">
    <title><?php echo $product_name; ?> - Shop - Daily Buy Mart</title>
</head>
<body>
    <header class="shop-header">
        <div class="logo-div">
            <img src="./media/logo-png.png" alt="Daily-Buy-Mart" class="logo-dbm"  onclick="window.location.assign('Home')">
        </div>
        <div class="for-search">
            <select name="item" id="item" class="top-search">
                <?php
                for($f=$z-1;$f>=0;$f--){
                    echo<<<offers_in_it
                    <option value="Special Offers">$offer_name[$f]</option>
offers_in_it;
                }
                ?>
            </select>
        </div>
        <div class="btn-div-top">
            <button class="btn btn-home-top" onclick="window.location.assign('Home')">Home</button>
            <button class="btn btn-track-top" onclick="window.location.assign('Shop')">Shop</button>
            <a href="<?php echo $map; ?>" target="_blank">
                <button class="btn btn-track-top"><i class="fas fa-map-marked-alt"></i> Track us</button>            
            </a>
            <button class="btn btn-track-top" id="catNavBars" onclick="catNav_Show()"><i class="fas fa-bars"></i></button>
            <button class="btn btn-track-top" id="catNavCut" onclick="catNav_Hide()"><i class="fas fa-times"></i></button>

        </div>
        <div style="clear: both;"></div>
    </header>
    <div class="category-shower" id="category">
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
    <div class="main-body">
        <nav class="nav-in-left" id="cat-nav">
            <span class="nav-heading">Categories</span>
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
            <span class="nav-heading nav-offer-heading">Offers</span>
            <?php
                if($off_num>0){
                    for($f=$off_num-1;$f>=0;$f--){
                        echo<<<offers
                        <a href="Shop?y=$off_id[$f]">
                            <span class="nav-item nav-item-1">$offer_namex[$f] &#8250;</span>
                        </a>
offers;
                    }
                }
            ?>
        </nav>
        <section class="content-section-right">
            <div class="left-for-item-photos">
                <div class="for-top-main-photo" onclick="document.getElementById('product-gallery').style.display = 'block';">
                    <img src="./media/miniProducts/<?php echo $main_image; ?>" alt="product-image" class="product-main-img"  id="top" >
                </div>
                <div class="for-bottom-more-images">
                    <?php
                    if($other_image==1){
                        for($s=$j-1;$s>=0;$s--){
                            echo<<<imgs
                                <div class="more-image-1" onclick="document.getElementById('product-gallery').style.display = 'block';">
                                    <img src="./media/miniProducts/$img[$s]" alt="product-image" class="product-more-img">
                                </div>
imgs;
                            if($s==$j-3){
                                break;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="right-for-item-content">
                <h3 class="product-brand-name" id="product">
                    <?php echo $brand_name; ?>
                </h3>
                <h4 class="product-name-heading">
                    <?php echo $product_name; ?>
                </h4>
                <span class="rating-des">
                <?php echo $rating; ?> <span class="star-ico"><i class="fas fa-star"></i></span>
                </span>
                <span class="rating-text">
                <?php echo $rating; ?> rating
                </span>
                <span class="rate-quantity-combine text-truncate">
                    <?php echo $quantity; ?> - Rs <?php echo $selling_price; ?> 
                </span>
                <span class="Mrp-text">
                    <!-- MRP -->
                </span>
                <span class="new-rate-text">
                    Rs <?php echo $selling_price; ?>
                </span>
                    <span class="old-rate-text">
                        MRP
                        <del class="del">
                        Rs <?php echo $mrp; ?>
                        </del>
                    </span>
                <span class="off-percentage">
                    <?php echo $discount; ?>% Off
                </span>
                <button class="btn btn-visit-our-store" onclick="visit_store();"><i class="fas fa-shopping-cart"></i> &nbsp; Visit Store</button>
                <button class="btn call-btn" onclick="call_us();"><i class="fas fa-phone-alt"></i></button>
                <button class="btn call-btn" onclick="chat('<?php echo $product_name; ?>');"><i class="fas fa-comment-dots"></i></button>

                <h3 class="more-quantities">
                    More Quantities
                </h3>
                <?php
                    for($f=$x-1;$f>=0;$f--){
                        echo<<<more
                            <a href="Product?display=$more_id[$f]">
                            <div class="more-quantity-card">
                                <span class="quantity-text-2">
                                    $more_quantity[$f]
                                </span>
                                <span class="rate-text-2">
                                    Rs $more_selling[$f] 
                                </span>
                                <span class="mrp-text-2">
                                    <del>Rs $more_mrp[$f]</del> 
                                </span>
                                <span class="absolute-tick">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            </div>
                            </a>
more;
               }
                ?>
               
                <div class="product-in-pack-wrapper">
                    <h4 class="product-in-pack-heading">
                        Specification :
                    </h4>
                    <ul>
                        <?php
                            if($l==0){
                                echo "<li>".$product_name."</li>";
                            }else{
                                for($e=0;$e<$l;$e++){
                                    echo<<<specifications
                                        <li>
                                            $specification[$e]
                                        </li>
specifications;     
                                }
                            }
                        
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <div style="clear: both;"></div>
    </div>
    <div class="similar-products" id="similar">
        <h4 class="similar-prodcut-heading">
            Similar products
        </h4>
        <div class="main-for-similar">
            
        <div class="cardOfcard-wrapper">
            <?php
            if($ss==0){
                echo "<h6 style='text-align:center;'>No similar item found</h6>";
            }else{
                for($xx = $ss-1; $xx>=0; $xx--){
                    echo<<<similars
                        <!-- card start from here 1 -->
                        <a href="Product?display=$similar_product_id[$xx]">
                        <div class="card-wrapper">
                            <div class="offpercent-card-wrapper">
                                <span class="offpercent-card">
                                    $similar_product_discount[$xx]% off
                                </span>
                                <div style="clear: both;"></div>
                            </div>
                            <div class="card-image-wrapper">
                                <img src="./media/miniProducts/$similar_product_img[$xx]" alt="dbm-Product" class="product-png">  
                            </div>
                            <span class="brandname-insidecard text-truncate">$similar_product_brandname[$xx]</span>
                            <h4 class="product-name text-truncate">
                                $similar_product_name[$xx]
                            </h4>
                            <span class="star-ratting-design">
                                $similar_product_rating[$xx]
                                <span class="material-icons star-font">
                                    star
                                </span>
                            </span>
                            <span class="rating-text-insideCard">
                                $similar_product_rating[$xx] rating
                            </span>
                            <span class="quantity-rate text-truncate">
                                $similar_product_quantity[$xx] - Rs $similar_product_selling[$xx]
                            </span>
                            <div class="mrp-wrapper text-truncate">
                                <span class="newPrice-text">
                                    Rs $similar_product_selling[$xx]
                                </span>
                                <span class="mrp-text">
                                    MRP
                                </span>
                                <span class="mrpRs-text">
                                    <del>Rs $similar_product_mrp[$xx]</del>
                                </span>
                            </div>
                            <span class="offer-type text-truncate">
                                &middot; $similar_offer_name[$xx]
                            </span>
                            <div class="card-button-wrappers">
                            <a>
                            <button class="btn-card-visit"  onclick="visit_store();" id="lap-btn">Visit Store</button>
                        </a>
                        <a>
                            <button class="btn-card-visit" onclick="visit_store();" id="mobi-btn"><i class="fas fa-store-alt"></i></button>
                        </a>
                        <button class="btn-card btn-card-call" onclick="call_us();"><i class="fas fa-phone-alt"></i></button>
                                <button class="btn-card btn-card-message" onclick="chat('$similar_product_name[$xx]');"><i class="far fa-comment-dots"></i></button>
                            </div>
                        </div>
                        </a>
                        <!-- card ends up here 1 -->
similars;
                    if($xx == $ss-4){
                        break;
                    }
                }
            }
            ?>

            <div style="clear: both;"></div>
        </div>
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
                <a href="#similar">
                    <span class="footer-part-1-item">Similar Product</span>
                </a><br/>
                <a href="#category">
                    <span class="footer-part-1-item" onclick="handle_offer_product()">Categories</span>
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

    <div class="for-chat-wrapper" id="product-gallery">
        <div class="gallery-wrapper">
            <span class="cut-gallery">
                <i class="fas fa-times" onclick="document.getElementById('product-gallery').style.display = 'none';"></i>
            </span>
            <div class="for-gallery-img">
                <img src="media/miniProducts/<?php echo $main_image; ?>" class="gallery-img" alt="Product" id="gallery-img">
            </div>
            <!-- <div class="for-control">
                <button class="btn btn-primary btn-control">Previous</button>
                <button class="btn btn-primary btn-control">Next</button>
            </div> -->
            <div class="mini-image-control">
                    <?php
                        if($other_image!=0){
                            for($img=0;$img<count($all_img);$img++){
                                echo<<<galleryMini
                                <div class="for-mini-image">
                                    <img src="media/miniProducts/$all_img[$img]" alt="Product-mini-img" class="mini-gallery-img"  onclick="change_image('media/miniProducts/$all_img[$img]')">
                                </div>

galleryMini;
                            }
                        }
                    ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    mysqli_close($con);
?>