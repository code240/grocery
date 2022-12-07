<?php
    include "backend/is_login.php";
    include "backend/data_count.php";
    include "backend/database.php";
    $q1 = "SELECT * FROM basic_data";
    $get_basic = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_basic)){
        $shopname = $r["shop_name"];
        $shopaddress = $r["shop_address"];
        $shortaddress = $r["short_address"];
        $mobile = $r["mobile"];
        $email = $r["email_id"];
        $map = $r["map_url"];
        $embed = $r["embed_map"];
        $upto = $r["upto_off"];
        $password = $r["password"];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <!-- Font awsome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&style=outlined" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/offer.css">
    <link rel="stylesheet" href="css/setting.css">

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
            <span class="nav-btn"><i class="fas fa-comment-alt"></i> &nbsp; Messages</span>
        </a>
        <a href="Setting">
            <span class="nav-btn active"><i class="fas fa-cog"></i> &nbsp; Setting</span>
        </a>


    </nav>
    <div class="main-body main-body-2">
        <div class="content-heading">
            <h1 class="heading">
                Manage Pannel
            </h1>
        </div>
        <div class="table-div-offer">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#Num</th>
                        <th scope="col">Name</th>
                        <th scope="col">Content</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Shop Name</td>
                        <td class="answer-td"><?php echo $shopname; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic1').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Shop Address</td>
                        <td class="answer-td"><?php echo $shopaddress; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic2').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Shop Address Inshort</td>
                        <td class="answer-td"><?php echo $shortaddress; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic3').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Mobile</td>
                        <td class="answer-td"><?php echo $mobile; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic4').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Email Address</td>
                        <td class="answer-td"><?php echo $email; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic5').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Map Url</td>
                        <td class="answer-td"><?php echo $map; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic6').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Location Embed url</td>
                        <td class="answer-td"><?php echo $embed; ?></td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic7').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>Off upto</td>
                        <td class="answer-td"><?php echo $upto; ?>%</td>
                        <td><button class="btn btn-success"  onclick="document.getElementById('basic8').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">9</th>
                        <td>Password</td>
                        <td class="answer-td">*********</td>
                        <td><button class="btn btn-success" onclick="document.getElementById('basic9').style.display = 'block';">Edit</button></td>
                    </tr>
                    <tr>
                        <th scope="row">10</th>
                        <td>Logout</td>
                        <td>Logout Pannel</td>
                        <td><button class="btn btn-danger" onclick="window.location.assign('backend/logout.php');">Logout</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        

    </div>

    <div class="background-black" id="basic1">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic1').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Shop Name
            </h5>
            <form action="backend/basic_edit_shopname.php" method="POST">
                <input type="text"  name="shopname" value="<?php echo $shopname; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>

    
    <div class="background-black" id="basic2">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic2').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Shop Address
            </h5>
            <form action="backend/basic_edit_shopaddress.php" method="POST">
                <input type="text"  name="shopaddress" value="<?php echo $shopaddress; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>

    
    <div class="background-black" id="basic3">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic3').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Short Shop Address
            </h5>
            <form action="backend/basic_edit_shortaddress.php" method="POST">
                <input type="text"  name="shortaddress" value="<?php echo $shortaddress; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>


    <div class="background-black" id="basic4">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic4').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Mobile Number
            </h5>
            <form action="backend/basic_edit_mobile.php" method="POST">
                <input type="text"  name="mobile" value="<?php echo $mobile; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>


    
    <div class="background-black" id="basic5">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic5').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Email Address
            </h5>
            <form action="backend/basic_edit_email.php" method="POST">
                <input type="email"  name="email" value="<?php echo $email; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>


    
    <div class="background-black" id="basic6">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic6').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Map Url
            </h5>
            <form action="backend/basic_edit_url.php" method="POST">
                <input type="text"  name="url" value="<?php echo $map; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>


    
    <div class="background-black" id="basic7">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic7').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Embed url
            </h5>
            <form action="backend/basic_edit_embed.php" method="POST">
                <textarea  name="embed" required placeholder="Enter the shop name here" class="input-fixed large-fix-input" autocomplete="off"><?php echo $embed; ?></textarea>
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>


    
    <div class="background-black" id="basic8">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic8').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Discout upto
            </h5>
            <form action="backend/basic_edit_upto.php" method="POST">
                <input type="text"  name="upto" value="<?php echo $upto; ?>" required placeholder="Enter the shop name here" class="input-fixed" autocomplete="off">
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>


    
    <div class="background-black" id="basic9">
        <div class="input-div-fixed">
            <span class="cut-btn"  onclick="document.getElementById('basic9').style.display = 'none';"><i class="fa fa-times"></i></span>
            <h5 class="fixed-heading">
                Change Password
            </h5>
            <form action="backend/basic_edit_password.php" name="ps_form" method="POST" onsubmit="return check_ps()">
                <input type="text"  name="oldps" pattern=".{6,50}" title="6 to 50 characters" required placeholder="Old password" class="input-fixed" autocomplete="off">
                <input type="text"  name="newps" pattern=".{6,50}" title="6 to 50 characters" required placeholder="New Password" class="input-fixed" autocomplete="off">
                <input type="text"  name="cps" pattern=".{6,50}" title="6 to 50 characters" required placeholder="Confirm Password" class="input-fixed" autocomplete="off">
                
                <input type="submit" value="Save change" class="btn btn-primary btn-submit-change">
            </form>
            
        </div>
    </div>

</body>
</html>
<?php
    mysqli_close($con);
?>