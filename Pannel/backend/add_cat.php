<?php
if(!isset($_POST["cat"])){
    echo "error";
    exit;
}
include("database.php");
$pid = $_POST["pid"];
$cat = $_POST["cat"];
$q1 = "SELECT cats FROM product WHERE product_id = '$pid'";
$get_q1 = mysqli_query($con,$q1);
while($r = mysqli_fetch_array($get_q1)){
    $cats = $r["cats"];
}
$explode_cat = explode(",",$cats);
if(in_array($cat,$explode_cat)){
    echo "<h1>This category has already been added...</h1>";
    header("refresh:4;url=../Product.php?display=".$pid);
    mysqli_close($con);
    exit; 
}else{
    $cats .= $cat.",";
}

$q2 = "UPDATE product SET cats = '$cats' WHERE product_id = '$pid'";
if(mysqli_query($con,$q2)){
    echo "<h1>Category Successfully added...</h1>";
    header("refresh:2;url=../Product.php?display=".$pid); 
}else{
    echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
    header("refresh:4;url=../Product.php?display=".$pid); 
}
mysqli_close($con);

?>