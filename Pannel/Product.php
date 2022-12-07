<?php
    include "backend/is_login.php";
    include "backend/data_count.php";
    include "backend/database.php"; 
    error_reporting(0);
    if(!isset($_GET["display"])){
        header("location:Pannel-Home");
        exit;
    }

    $pid = $_GET['display'];
    $q1 = "SELECT * FROM product WHERE product_id = '$pid'";
    $get_data = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_data)){
        $idd = (string)$r["id"];
        if(strlen($idd)==1){$id = "0".$idd;}
        else{ $id = $idd; }    

        $brand = $r['brand'];
        $itemname = $r['item_name'];
        $rating = $r['rating'];
        $product_id = $r['product_id'];
        $mrp = $r['mrp'];
        $sell = $r['selling_price'];
        $discount = $r['discount'];
        $pin = $r['pin'];
        $quantity = $r['quantity'];
        $pcode = $r['product_code'];
        $offer = $r['offers'];
        $cats = $r['cats'];
        
        // Get Images
        $q2 = "SELECT * FROM media WHERE product_id = '$pid'";
        $get_imgs = mysqli_query($con,$q2);
        $img_found = 0;
        $x = 0;
        $img_code_str = "";
        while($s = mysqli_fetch_assoc($get_imgs)){
            if($s['active_image']=='1'){
                $main_img = $s['image_name'];
                $img_found = 1;
            }else{
                $all_imgs[$x] = $s["image_name"];
                $img_codes[$x] = $s["image_code"];
                $img_code_str .= $s["image_code"].",";
                $x++;
            }
        }
        if($img_found==0){
            $main_img = 'no_image.jpg';
        }

        

        // Get Specifications specification
        $q3 = "SELECT * FROM specification WHERE product_id = '$pid'";
        $get_specifications = mysqli_query($con,$q3);
        $y = 0;
        while($s = mysqli_fetch_array($get_specifications)){
            $des[$y] = $s['description'];
            $desCode[$y] = $s['data_code'];
            $y++;
        }



        // Get Category
        $explode_cats = explode(",",$cats);
        $q4 = "SELECT * FROM category";
        $get_cat_data = mysqli_query($con,$q4);
        $z=0;
        $zz=0;
        $my_cat = [];
        $rest_cat = [];
        while($s = mysqli_fetch_assoc($get_cat_data)){
            if(in_array($s["cat_code"],$explode_cats)){
                $my_cat[$z] = $s["cat_name"];
                $my_cat_code[$z] = $s["cat_code"];
                $z++;
            }else{
                $rest_cat[$zz] = $s["cat_name"];
                $rest_cat_code[$zz] = $s["cat_code"];
                $zz++;
            }
        }


        // Get Offers
        $explode_offer = explode(",",$offer);
        $q5 = "SELECT * FROM offer";
        $o = 0;
        $oo = 0;
        $get_offers = mysqli_query($con,$q5);
        while($s = mysqli_fetch_assoc($get_offers)){
            if(in_array($s['offer_code'],$explode_offer)){
                $my_offer[$o] = $s["offer_name"];
                $my_offer_code[$o] = $s["offer_code"];
                $o++;
            }else{
                $rest_offer[$oo] = $s["offer_name"];
                $rest_offer_code[$oo] = $s["offer_code"];
                $oo++;
            }
        }


    }


    $q6 = "SELECT * FROM product WHERE product_code = '$pcode'";
    $get_quantity = mysqli_query($con,$q6);
    $q=0;
    while($r = mysqli_fetch_array($get_quantity)){
        $more_quantity[$q] = $r["quantity"];
        $more_quantity_id[$q] = $r["product_id"];
        $q++;
    }

?>

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
    <title>Pannel - DailyBuyMart</title>
</head>
<body>
    <header class="top-header">
        <h6 class="header-heading">
            Total Product : <span class="green"><?php echo $product_count_2; ?></span> | 
            Total Categories : <span class="green"><?php echo $cat_count_2; ?></span> | 
            Total Offers : <span class="green"><?php echo $offer_count_2; ?></span>
        </h6>
        <?php
        if($pin=='1'){
            echo<<<unpin_item
                <a href="backend/pin_product.php?pin=0&pid=$pid">
                <button class="btn btn-danger btn-add-new">
                    <i class="fas fa-thumbtack"></i> &nbsp; Unpin Product
                </button>
                </a>
unpin_item;    
        }else{
            echo<<<pin_item
                <a href="backend/pin_product.php?pin=1&pid=$pid">
                <button class="btn btn-warning btn-add-new">
                    <i class="fas fa-thumbtack"></i> &nbsp; Pin Product
                </button>
                </a>
pin_item;
        } 
        ?>
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
            <span class="nav-btn nav-btn-1 active"><i class="fas fa-shopping-basket"></i> &nbsp; Products</span>
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
            <span class="nav-btn"><i class="fas fa-comment-alt"></i> &nbsp; Messages</span>
        </a>
        <a href="Setting">
            <span class="nav-btn"><i class="fas fa-cog"></i> &nbsp; Setting</span>
        </a>


    </nav>
    <div class="main-body main-body-2">
        <div class="main-body-top text-truncate">
            <span class="main-body-top-text "><?php echo $id; ?>: <?php echo $itemname; ?>  </span>
        </div>
        <div class="div-for-images">
            <div class="main-img-product-div">
                <img src="../media/miniProducts/<?php echo $main_img; ?>" alt="main-img-product-dbm" class="main-img-product">
            </div>
            <div class="inner-for-images">
                <?php
                    for($j=$x-1;$j>=0;$j--){
                        echo<<<imgs
                            <div class="product-images" onclick="select_image('$img_codes[$j]','$img_code_str')" id="$img_codes[$j]">
                                <img src="../media/miniProducts/$all_imgs[$j]" alt="my-img" class="product-imgs">
                            </div>
imgs;
                    }
                ?>
                <div style="clear: both;"></div>
        </div>
            <button class="btn btn-success btn-img-ctrl" onclick="update_pin()">Pin</button>
            <button class="btn btn-primary btn-img-ctrl" onclick="add_new_img_show()">Add New</button>
            <button class="btn btn-danger btn-img-ctrl" onclick="delete_pin()">Delete</button>
        </div>
        <div class="for-content-part">
            <h6 class="brand-heading">
                <?php echo $brand; ?> &nbsp;<span class="red"><i class="fas fa-edit" onclick="edit_brand_show()"></i></span>
            </h6>
            <h1 class="product-heading">
                <?php echo $itemname; ?>  &nbsp;<span class="red"><i class="fas fa-edit" onclick="edit_item_show()"></i></span>
            </h1>
            <h6 class="mrp-price-product">
                MRP Rs : <span class="blue"><?php echo $mrp; ?></span>   &nbsp;<span class="red"><i class="fas fa-edit" onclick="edit_mrp_show()"></i></span>
            </h6>
            <h6 class="mrp-price-product">
                Selling Price : <span class="blue"><?php echo $sell; ?></span>   &nbsp;<span class="red"><i class="fas fa-edit" onclick="edit_sell_show()"></i></span>
            </h6>
            <h6 class="mrp-price-product">
                Quantity : <span class="blue"><?php echo $quantity; ?></span>   &nbsp;<span class="red"><i class="fas fa-edit"  onclick="edit_quantity_show()"></i></span>
            </h6>
            <h6 class="mrp-price-product">
                Discount : <span class="blue"><?php echo $discount; ?>%</span>
            </h6>
            <h6 class="mrp-price-product">
                Product code : <span class="blue"><?php echo $pcode; ?></span>
            </h6>
            <h6 class="mrp-price-product">
                Product number : <span class="blue"><?php echo $id; ?></span>
            </h6>
            <h6 class="mrp-price-product mt-4">
                Specifications :
            </h6>
            <ul>
                <?php
                    for($j=$y-1;$j>=0;$j--){
                        echo<<<specification
                            <li>$des[$j]   &nbsp;<span class="red-dlt"><i class="fas fa-trash-alt" onclick="remove_des('$des[$j]','$desCode[$j]')"></i></span></li>
specification;
                    }
                    if($y==0){
                        echo "No data";
                    }
                ?>
            </ul>
            <h6 class="mrp-price-product mt-4">
                Category Included :
            </h6>
            <ul>
                <?php
                if($z!=0){
                    for($j=$z-1;$j>=0;$j--){
                        echo<<<cats
                            <li>$my_cat[$j]   &nbsp;<span class="red-dlt"><i class="fas fa-trash-alt" onclick="remove_cat('$my_cat[$j]','$my_cat_code[$j]')"></i></span></li>
cats;
                    }
                }else{
                    echo "no data";
                }
                ?>
            </ul>
            <h6 class="mrp-price-product mt-4">
                Offers Included:
            </h6>
            <ul>
            <?php
                if($o!=0){
                    for($j=$o-1;$j>=0;$j--){
                        echo<<<offers
                            <li>$my_offer[$j]   &nbsp;<span class="red-dlt"><i class="fas fa-trash-alt" onclick="remove_offer('$my_offer[$j]','$my_offer_code[$j]')"></i></span></li>
offers;
                    }
                }else{
                    echo "no data";
                }
                ?>
            </ul>
            <h6 class="mrp-price-product mt-4">
                More Quantities :
            </h6>
            <div class="for-more-quantity">
                <?php
                    for($j=$q-1;$j>=0;$j--){
                        echo<<<quantity
                            <a href="Product?display=$more_quantity_id[$j]">
                                <span class="quantitiy-text">$more_quantity[$j]</span>
                            </a>
quantity;
                    }
                ?>
            </div>
            <br>
            <div class="input-forms-product">
                <h5>
                    Add Specification
                </h5>
                <form action="backend/add_description.php" method="POST">
                    <input type="text" required name="des" autocomplete="off" class="product-speci-input" placeholder="Short Description">
                    <input type="hidden" value="<?php echo $pid; ?>" name="pid">
                    <input type="submit" value="ADD" class="btn-file-upload">
                </form>
            </div>
            <div class="input-forms-product">
                <h5>
                    Add Category
                </h5>
                <form action="backend/add_cat.php"  method="POST">
                <select name="cat" id="cat-data" class="input-data-category">
                    <?php
                        for($j=$zz-1;$j>=0;$j--){
                            echo<<<restcats
                                <option value="$rest_cat_code[$j]">$rest_cat[$j]</option>
restcats;
                        }
                        if($zz==0){
                            echo '<optgroup label="No category left to add">';
                        }
                    ?>
                </select>
                <input type="hidden" name="pid" value="<?php echo $pid; ?>"> 
                <input type="submit" value="ADD" class="btn-file-upload">
                </form>
            </div>
            <div class="input-forms-product">
                <h5>
                    Add Offer
                </h5>
                <form action="backend/add_offer.php" method="POST">
                <select name="off" id="rating-data" class="input-data-category">
                <?php
                        for($j=$oo-1;$j>=0;$j--){
                            echo<<<restoffers
                                <option value="$rest_offer_code[$j]">$rest_offer[$j]</option>
restoffers;
                        }
                        if($oo==0){
                            echo '<optgroup label="All offer applied to this product">';
                        }
                    ?>
                </select>
                <input type="hidden" name="pid" value="<?php echo $pid; ?>"> 
                <input type="submit" value="ADD" class="btn-file-upload">
                </form>
            </div>
            <div class="input-forms-product mt-3">
                <h5>
                    Add New Quantity In this product
                </h5>
                <button class="btn btn-success mt-2" onclick="document.getElementById('add_new_div').style.display = 'block';">ADD NEW</button>
            </div>
            <div class="input-forms-product mt-5">
                <h5>
                    Delete this product
                </h5>
                <button class="btn btn-danger mt-1"  onclick="document.getElementById('confirm_box4').style.display = 'block'">Delete</button>
            </div>
        </div>

        <div style="clear: both;"></div>
    </div>





    <form action="backend/pin_img.php" id="pin_form" method="post">
        <input type="hidden" name="dpid" id="dpid">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="inp_pid">
    </form>
    <form action="backend/dlt_img.php" id="dlt_form" method="post">
        <input type="hidden" name="dpid" id="dpid_dlt">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    </form>



    <div class="add-image-wrapper" id="add_image">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Select an image</h1>
            <form action="backend/upload_dp.php" name="dp_form" onsubmit="return img_upload()" method="POST" enctype="multipart/form-data">
                <input type="file" accept="image/png, image/gif, image/jpeg" name="product_dp" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Upload" name="submit_dp_product" id="submit_img_upload" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="add_new_img_hide()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>

    <div class="add-image-wrapper" id="edit_brand">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Edit Brand Name</h1>
            <form action="backend/edit_brand.php" name="brand_form" onsubmit="return brand_edit()" method="POST">
                <input type="text" required autocomplete="off" placeholder="Enter Brand Name" value="<?php echo $brand; ?>" name="brandname" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Save Changes" name="submit_dp_product" id="edit_brandname_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="edit_brand_hide()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>

    <div class="add-image-wrapper" id="edit_itemname">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Edit Product Name</h1>
            <form action="backend/edit_itemname.php" name="name_form" onsubmit="return brand_edit()" method="POST">
                <input type="text" required autocomplete="off" placeholder="Enter Product Name" value="<?php echo $itemname; ?>" name="itemname" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Save Changes" name="submit_dp_product" id="edit_name_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="edit_item_hide()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>


    <div class="add-image-wrapper" id="edit_mrp">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Set new MRP</h1>
            <form action="backend/edit_mrp.php" name="mrp_form" onsubmit="return brand_edit()" method="POST">
                <input type="text" required autocomplete="off" placeholder="Enter MRP" value="<?php echo $mrp; ?>" name="mrp" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Save Changes" name="submit_dp_product" id="edit_mrp_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="edit_mrp_hide()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>


    <div class="add-image-wrapper" id="edit_sell">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Set new selling price</h1>
            <form action="backend/edit_sell.php" name="sell_form" onsubmit="return brand_edit()" method="POST">
                <input type="text" required autocomplete="off" placeholder="Enter selling price" value="<?php echo $sell; ?>" name="sell" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Save Changes" name="submit_dp_product" id="edit_sell_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="edit_sell_hide()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>


    
    <div class="add-image-wrapper" id="edit_quantity">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Set new quantity</h1>
            <form action="backend/edit_quantity.php" name="quantity_form" onsubmit="return brand_edit()" method="POST">
                <input type="text" required autocomplete="off" placeholder="Enter quantity" value="<?php echo $quantity; ?>" name="quantity" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Save Changes" name="submit_dp_product" id="edit_quantity_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="edit_quantity_hide()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>


    <div class="confirm-fixed" id="confirm_box">
        <div class="confirm-div">
            <h6 class="confirmation-heading" id="confirm_offer_heading">
                
            </h6>
            <div class="confirm-btns-div">
                <button class="btn btn-success btn-confirm-fix" onclick="remove_offer_confirmed()">Confirm</button>
                <button class="btn btn-danger btn-cancel-fix" onclick="document.getElementById('confirm_box').style.display = 'none'">Cancel</button>
            </div>
        </div>
    </div>
    <!-- form for remove offer -->
    <form action="backend/remove_offer.php" method="POST"  name="remove_offer_form" id="remove_offer_form">
        <input type="hidden" name="offerToBeRemoved" id="offerToBeRemoved">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">

    </form>



    

    <div class="confirm-fixed" id="confirm_box2">
        <div class="confirm-div">
            <h6 class="confirmation-heading" id="confirm_cat_heading">
                
            </h6>
            <div class="confirm-btns-div">
                <button class="btn btn-success btn-confirm-fix" onclick="remove_cat_confirmed()">Confirm</button>
                <button class="btn btn-danger btn-cancel-fix" onclick="document.getElementById('confirm_box2').style.display = 'none'">Cancel</button>
            </div>
        </div>
    </div>
    <!-- form for remove offer -->
    <form action="backend/remove_category.php" method="POST"  name="remove_cat_form" id="remove_cat_form">
        <input type="hidden" name="catToBeRemoved" id="catToBeRemoved">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    </form>


    <div class="confirm-fixed" id="confirm_box3">
        <div class="confirm-div">
            <h6 class="confirmation-heading" id="confirm_des_heading">
                
            </h6>
            <div class="confirm-btns-div">
                <button class="btn btn-success btn-confirm-fix" onclick="remove_des_confirmed()">Confirm</button>
                <button class="btn btn-danger btn-cancel-fix" onclick="document.getElementById('confirm_box3').style.display = 'none'">Cancel</button>
            </div>
        </div>
    </div>
    <!-- form for remove offer -->
    <form action="backend/remove_specification.php" method="POST"  name="remove_des_form" id="remove_des_form">
        <input type="hidden" name="desToBeRemoved" id="desToBeRemoved">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    </form>





    <div class="confirm-fixed" id="confirm_box4">
        <div class="confirm-div">
            <h6 class="confirmation-heading" id="confirm_delete_heading">
                Are you sure you want to delete this product?
            </h6>
            <div class="confirm-btns-div">
                <button class="btn btn-success btn-confirm-fix" onclick="delete_confirmed()">Confirm</button>
                <button class="btn btn-danger btn-cancel-fix" onclick="document.getElementById('confirm_box4').style.display = 'none'">Cancel</button>
            </div>
        </div>
    </div>
    <!-- form for remove offer -->
    <form action="backend/delete_product.php" method="POST"  name="delete_form" id="del_form">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    </form>
    




    <div class="add-image-wrapper" id="add_new_div">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Add new quantity in this product</h1>
            <form action="backend/add_new_quantity.php" name="new_quantity_form" onsubmit="return add_new_quantity_form()" method="POST">
                <label class="new_quantity_label">Product title</label>
                <input type="text" required autocomplete="off" placeholder="Enter Product Name" value="<?php echo $itemname; ?>" name="itemname" class="file_input_add_new add_new_quantity_input">
                <label class="new_quantity_label">Quantity</label>
                <input type="text" required autocomplete="off" placeholder="Enter Quantity"  name="quantity" class="file_input_add_new add_new_quantity_input">
                <label class="new_quantity_label">MRP Price</label>
                <input type="number" required autocomplete="off" placeholder="Enter MRP price"  name="mrp" class="file_input_add_new add_new_quantity_input">
                <label class="new_quantity_label">Selling Price</label>
                <input type="number" required autocomplete="off" placeholder="Enter Selling price"  name="selling" class="file_input_add_new add_new_quantity_input">

                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="hidden" name="pcode" value="<?php echo $pcode; ?>">
                <input type="submit" value="Add product" name="submit_new_quantity_product" id="edit_nqp_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="document.getElementById('add_new_div').style.display = 'none';">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>




<!--     
    <div class="add-image-wrapper" id="add_des">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Add new specification</h1>
            <form action="backend/add_description.php" name="des_form" onsubmit="return add_des()" method="POST">
                <input type="text" required autocomplete="off" placeholder="Enter specification" name="des" class="file_input_add_new">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="submit" value="Add specification" id="add_des_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="document.getElementById('add_des').style.display='none'">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div> -->



    
</body>
</html>
<?php
    mysqli_close($con);
?>