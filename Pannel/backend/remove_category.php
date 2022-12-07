<?php
    if(!isset($_POST["catToBeRemoved"])){
        echo "error";
        exit;
    }
    include "database.php";
    $catcode = $_POST["catToBeRemoved"];
    $pid = $_POST["pid"];
    $q1 = "SELECT cats FROM product WHERE product_id = '$pid'";
    $get_cats = mysqli_query($con,$q1);
    while($r = mysqli_fetch_assoc($get_cats)){
        $cats = $r["cats"];
    }
    $explode_cats = explode(",",$cats);
    if(count($explode_cats)==2){
        echo "<script>alert('There is only one category applied to this product. So we cannot remove this one.'); window.location.assign('../Product?display=$pid');</script>";
        mysqli_close($con);
        exit;
    }
    $newcatlist="";
    for($i=0;$i<count($explode_cats)-1;$i++){
        if($explode_cats[$i]!=$catcode){
            $newcatlist .= $explode_cats[$i].",";
        }
    }
    $q2 = "UPDATE product SET cats = '$newcatlist' WHERE product_id = '$pid'";
    if(mysqli_query($con,$q2)){
        echo "<h1>Category removed successfully <br>Redirecting....</h1>";
        header( "refresh:2;url=../Product.php?display=".$pid);
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid); 
    }
    mysqli_close($con);

?>