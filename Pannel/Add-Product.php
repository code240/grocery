<?php
    include "backend/is_login.php";
    include "backend/data_count.php";
    include "backend/database.php";
    $q1 = "SELECT * FROM offer";
    $get_offer = mysqli_query($con,$q1);
    $i=0;
    while($r = mysqli_fetch_assoc($get_offer)){
        $offer_name[$i] = $r["offer_name"];
        $offer_code[$i] = $r["offer_code"];
        $i++;
    }

    $q1 = "SELECT * FROM category";
    $get_cat = mysqli_query($con,$q1);
    $j=0;
    while($r = mysqli_fetch_assoc($get_cat)){
        $cat_name[$j] = $r["cat_name"];
        $cat_code[$j] = $r["cat_code"];
        $j++;
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
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        <button class="btn btn-success btn-add-new" onclick="window.location.assign('Pannel-Home')">
            <i class="fas fa-shopping-basket"></i> &nbsp; View Products 
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
            <span class="nav-btn active"><i class="fas fa-plus-circle"></i>  &nbsp; Add Product</span>
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
    <div class="main-body">
        <div class="add-product-wrapper">
            <div class="content-heading">
                <h1 class="heading">
                    Add a Product
                </h1>
            </div>
            <div class="form-wrapper">
                <form action="backend/add_product.php" method="post" name="new" onsubmit="return new_product()" enctype="multipart/form-data">
                <div class="form-data-1">
                    <label for="brandname" class="label-data">Brand Name :<span style="color:red;"> *</span></label>
                    <input type="text" name="brandname" autocomplete="off" id="brandname" class="input-data" placeholder="Brand name">
                </div>
                <div class="form-data-1 form-data-2">
                    <label for="productname" class="label-data">Product Name :<span style="color:red;"> *</span></label>
                    <input type="text" name="productname" autocomplete="off" id="productname" class="input-data" placeholder="Product name">
                </div>
                <div class="form-data-1">
                    <label for="mrp" class="label-data">Product MRP :<span style="color:red;"> *</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rs</span>
                        </div>
                        <input type="number" name="mrp" autocomplete="off" id="mrp" class="form-control" placeholder="Product MRP (ex: 150.00)" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-data-1 form-data-2">
                    <label for="sell" class="label-data">Selling Price: <span style="color:red;"> *</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rs</span>
                        </div>
                        <input type="number" name="sell" autocomplete="off" id="sell" class="form-control" placeholder="Selling price (ex: 120.00)" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-data-1">
                    <label for="quantity" class="label-data">Quantity :<span style="color:red;"> *</span></label>
                    <input type="text" name="quantity" autocomplete="off" id="quantity" class="input-data" placeholder="Quantity (250gm)">
                </div>
                <div class="form-data-1 form-data-2">
                    <label for="rating-data" class="label-data">Product Rating :<span style="color:red;"> *</span></label>
                    <select name="rating" id="rating-data" class="input-data">
                        <option value="4.6">4.6 Rating (default)</option>
                        <option value="5.0">5.0 Rating</option>
                        <option value="4.9">4.9 Rating</option>
                        <option value="4.8">4.8 Rating</option>
                        <option value="4.7">4.7 Rating</option>
                        <option value="4.5">4.5 Rating</option>
                        <option value="4.4">4.4 Rating</option>
                        <option value="4.3">4.3 Rating</option>
                        <option value="4.2">4.2 Rating</option>
                        <option value="4.1">4.1 Rating</option>
                        <option value="4.0">4.0 Rating</option>
                        <option value="3.8">3.8 Rating</option>
                        <option value="3.6">3.6 Rating</option>
                        <option value="3.4">3.4 Rating</option>
                        <option value="3.2">3.2 Rating</option>
                        <option value="3.0">3.0 Rating</option>
                        <option value="2.8">2.8 Rating</option>
                        <option value="2.6">2.6 Rating</option>
                        <option value="2.4">2.4 Rating</option>
                        <option value="2.2">2.2 Rating</option>
                        <option value="2.0">2.0 Rating</option>
                        <option value="1.8">1.8 Rating</option>
                        <option value="1.4">1.4 Rating</option>
                        <option value="1.0">1.0 Rating</option>
                        <option value="0.8">0.8 Rating</option>
                        <option value="0.4">0.4 Rating</option>
                        <option value="0.0">0.0 Rating</option>

                    </select>
                </div>
                <div class="form-data-1">
                    <label for="product-img" class="label-data">Product Image :<span style="color:red;"> *</span></label>
                    <input type="file" name="img" accept="image/png, image/gif, image/jpeg" id="product-img" class="input-data img-input" placeholder="Choose File">
                </div>
                <div class="form-data-1 form-data-2">
                    <label for="productdes" class="label-data">Description :</label>
                    <input type="text" name="productdes" autocomplete="off" id="productdes" class="input-data" placeholder="Short Description">
                </div>
                <div class="form-data-1">
                    <label for="cat-data" class="label-data">Add to the category :<span style="color:red;"> *</span></label>
                    <select name="cat" id="cat-data" class="input-data">
                        <?php
                            for($x=0;$x<$j;$x++){
                                echo<<<cat
                                    <option value="$cat_code[$x]">$cat_name[$x]</option>
cat;
                            }
                        ?>
                    
                    </select>
                </div>
                <div class="form-data-1 form-data-2">
                    <label for="offer-data" class="label-data">Add to the offer :<span style="color:red;"> *</span></label>
                    <select name="offer" id="offer-data" class="input-data">
                        <?php
                            for($x=0;$x<$i;$x++){
                                echo<<<off
                                    <option value="$offer_code[$x]">$offer_name[$x]</option>
off;
                            }
                        ?>
                    </select>
                </div>
                <input type="submit" class="btn add-product-btn" value="Add product">
            </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    mysqli_close($con);
?>