<?php
    include "backend/is_login.php";
    include "backend/data_count.php";
    include "backend/database.php";
    
    $q1 = "SELECT * FROM offer";
    $get_off = mysqli_query($con,$q1);
    $i = 0;
    while($r = mysqli_fetch_assoc($get_off)){
        $off_name[$i] = $r["offer_name"];
        $off_code[$i] = $r["offer_code"];
        $off_id[$i] = $r["id"];
        $do = $off_code[$i];
        $q2 = "SELECT * FROM product WHERE offers LIKE '%$do%'";
        $get_p_count = mysqli_query($con,$q2);
        $product_count[$i] = mysqli_num_rows($get_p_count);
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
            <span class="nav-btn active"><i class="fas fa-grin-beam"></i> &nbsp; Offers</span>
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
        <div class="content-heading">
            <h1 class="heading">
                Manage Offers
            </h1>
        </div>
        <div class="table-div-offer">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#Num</th>
                    <th scope="col">Offer Name</th>
                    <th scope="col">id</th>
                    <th scope="col">Products</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    for($x=0;$x<$i;$x++){
                        $xx = $x+1; 
                        echo<<<rows
                        <tr>
                            <th scope="row">$xx</th>
                            <td>$off_name[$x]</td>
                            <td>$off_id[$x]</td>
                            <td>$product_count[$x]</td>
                            <td><button class="btn btn-success" onclick="edit_offer('$off_name[$x]','$off_code[$x]')">Edit</button></td>
                            <td><button class="btn btn-danger" onclick="del_offer('$off_code[$x]')">Delete</button></td>
                        </tr>                   
rows;
                    }
                ?>
                </tbody>
              </table>
        </div>
        <div class="add-new-offer-wrapper">
            <h3 class="add-new-heading">
                Add new offer:
            </h3>
            <form action="backend/create_offer.php" method="POST" name="new_offer_name_form" onsubmit="return create_offer_validate()">
                <input type="text" class="input-offer-data" name="offername" autocomplete="off" required placeholder="Enter the offer name"  pattern=".{3,30}" title="Three to Thirty characters">
                <input type="submit" value="ADD" class="btn btn-primary btn-add-offer">
            </form>
            
        </div>

    </div>



    <div class="add-image-wrapper" id="edit_offer_name">
        <div class="add-image-inner-wrapper">
            <h1 class="add-img-heading">Edit offer name</h1>
            <form action="backend/offername_edit.php" name="edit_offername_form" method="POST">
                <input type="text" required autocomplete="off" placeholder="Offer" id="offer_inp"  name="offer" class="file_input_add_new">
                <input type="hidden" name="ofcode" id="ofcode">
                <input type="submit" value="Save Changes" name="submit_offer_new_name" id="edit_brandname_btn" class="btn btn-primary submit-add-new-file">
            </form>
            <span class="cross-sign" onclick="document.getElementById('edit_offer_name').style.display = 'none';">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>
</body>
</html>
<?php
    mysqli_close($con);
?>