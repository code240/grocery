<?php
    include "backend/is_login.php";
    include "backend/data_count.php";
    include "backend/database.php";
    
    if(isset($_GET["pin"])){
        if($_GET["pin"]=="true"){
            $q="SELECT * FROM product WHERE pin = '1'";
        }else{
            $q = "SELECT * FROM product";
        }
    }else{
        $q = "SELECT * FROM product";
    }



    $get_products = mysqli_query($con,$q);
    $i=0;
    while($r = mysqli_fetch_array($get_products)){
        $idd = $r["id"];
        $id_str = (string)$idd;
        // $x = gettype($id_str);
        // echo '<script>alert($x);</script>';
        if(strlen($id_str)==1){
            $id[$i] = "0".$id_str;
        }else{
            $id[$i] = $id_str;
        }
        $brandname[$i] = $r["brand"];
        $itemname[$i] = $r["item_name"];
        $rating[$i] = $r["rating"];
        $product_id[$i] = $r["product_id"];
        $discount[$i] = $r["discount"];
        $mrp[$i] = $r["mrp"];
        $selling[$i] = $r["selling_price"];
        $quantity[$i] = $r["quantity"];
        $q2 = "SELECT * FROM media WHERE product_id = '$product_id[$i]' AND active_image = '1'";
        $get_img = mysqli_query($con,$q2);
        $img_count = mysqli_num_rows($get_img);
        if($img_count==0){
            $product_img[$i] = "no_image.jpg";
        }else{
            while($s=mysqli_fetch_array($get_img)){
                $product_img[$i] = $s["image_name"];
                break;
            }
        }
        $i++;
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

    <title>Pannel - DailyBuyMart</title>
</head>
<body>
    <header class="top-header">
        <h6 class="header-heading">
            Total Product : <span class="green"><?php echo $product_count_2; ?></span> | 
            Total Categories : <span class="green"><?php echo $cat_count_2; ?></span> | 
            Total Offers : <span class="green"><?php echo $offer_count_2; ?></span>
        </h6>
        <a href="Pannel-Home?pin=true">
            <button class="btn btn-success btn-add-new">
                <i class="fas fa-eye"></i>&nbsp; View Pin Products
            </button>
        </a>
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
        <div class="add-product-wrapper">
            <div class="content-heading">
                <h1 class="heading">
                    Control All Products
                </h1>
            </div>
            <div class="items-wrapper">
                <?php
                for($j=$i-1;$j>=0;$j--){
                    echo<<<card
                        <!-- Card div start -->
                        <a href="Product?display=$product_id[$j]">
                        <div class="card-main">
                            <h6 class="item-number-heading">$id[$j]</h6>
                            <div class="item-img-wrapper">
                                <img src="../media/miniProducts/$product_img[$j]" alt="product-img" class="item-img">
                            </div>
                            <h6 class="item-brandname text-truncate">$brandname[$j]</h6>
                            <h6 class="item-name text-truncate">$itemname[$j]</h6>
                            <span class="item-rating text-truncate">$rating[$j] &nbsp; <i class="fas fa-star"></i></span>
                            <h6 class="quantity-text text-truncate">$quantity[$j]</h6>
                            <div class="item-rates text-truncate">
                                <span class="item-sell-rate">Rs $selling[$j]</span> 
                                <span class="item-mrp">MRP</span>
                                <span class="item-mrp-rate"><del>Rs $mrp[$j]</del></span>
                            </div>
                            <button class="btn-view-details">View Details</button>
                            <button class="btn-view-details btn-delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                        </a>
                        <!-- card div 1 over -->
card;
                }
                ?>


                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    mysqli_close($con);
?>