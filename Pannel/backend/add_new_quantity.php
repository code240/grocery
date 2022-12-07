<?php
    if(!isset($_POST["pcode"])){
        echo "error";
        exit;
    }
    include "database.php";
    $quantity = $_POST["quantity"];
    $mrp = $_POST["mrp"];
    $selling = $_POST["selling"];
    $itemname = $_POST["itemname"];
    $pid = $_POST["pid"];
    $pcode = $_POST["pcode"];

    // $discount = intdiv($selling,$mrp);
    // echo $discount;
    if(!is_numeric($mrp) || !is_numeric($selling)){
        echo "enter a numeric value in mrp and selling price";
        mysqli_close($con);
        exit;
    }
    $mrp_int = (int)$mrp;
    $selling_int = (int)$selling;
    $x = (100-(($selling/$mrp)*100));
    $discount =  round($x);

    $q1 = "SELECT * FROM product WHERE product_id = '$pid'";
    $get_info = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_info)){
        $brand = $r["brand"];
        $rating = $r["rating"];
        $cats = $r["cats"];
        $offers = $r["offers"];
    }
    date_default_timezone_set('Asia/Kolkata');
    $time = date("dmyhis");
    $alpha = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    $alpha2 = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
    $r1 = rand(0,25);
    $r2 = rand(0,25);
    $r3 = rand(0,25);
    $r4 = rand(0,25);
    $r5 = rand(0,25);
    $r6 = rand(0,25);
    $r7 = rand(0,25);
    $r8 = rand(0,25);
    $r9 = rand(0,25);
    $combine = $alpha[$r1].$alpha[$r2].$alpha[$r3].$alpha2[$r1].$alpha[$r4].$alpha[$r5].$alpha[$r6].$alpha2[$r2].$alpha[$r7].$alpha2[$r8].$alpha[$r9]; 
    $new_pid = $combine.$time;

    $q2 = "INSERT INTO product (item_name,brand,rating,product_id,mrp,selling_price,discount,quantity,pin,delete_status,product_code,cats,offers) VALUES ('$itemname','$brand','$rating','$new_pid','$mrp','$selling','$discount','$quantity','0','0','$pcode','$cats','$offers')";
    if(mysqli_query($con,$q2)){
        echo "<h1>New quantity Successfully Added...</h1>";
        header("refresh:2;url=../Product.php?display=".$new_pid); 
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header("refresh:4;url=../Product.php?display=".$pid);
    }
    mysqli_close($con);
?>