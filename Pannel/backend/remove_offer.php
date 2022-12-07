<?php
    if(!isset($_POST["offerToBeRemoved"])){
        echo "error";
        exit;
    }
    include "database.php";
    $ofcode = $_POST["offerToBeRemoved"];
    $pid = $_POST["pid"];
    if($ofcode == "mix"){
        echo "You cannot remove this offer";
        exit;
    }
    $q1 = "SELECT offers FROM product WHERE product_id = '$pid'";
    $get_offers = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_offers)){
        $offers = $r["offers"];
    }
    $explode_offers = explode(",",$offers);
    if(count($explode_offers)==2){
        echo "<script>alert('There is only one offer applied to this product. So we cannot remove this one.'); window.location.assign('../Product?display=$pid');</script>";
        mysqli_close($con);
        exit;
    }
    $newofferlist="";
    for($i=0;$i<count($explode_offers)-1;$i++){
        if($explode_offers[$i]!=$ofcode){
            $newofferlist .= $explode_offers[$i].",";
        }
    }
    $q2 = "UPDATE product SET offers = '$newofferlist' WHERE product_id = '$pid'";
    if(mysqli_query($con,$q2)){
        echo "<h1>Offer removed successfully <br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid); 
    }
    mysqli_close($con);

?>