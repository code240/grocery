<?php
if(!isset($_POST["off"])){
    echo "error";
    exit;
}
include("database.php");
$pid = $_POST["pid"];
$off = $_POST["off"];
$q1 = "SELECT offers FROM product WHERE product_id = '$pid'";
$get_q1 = mysqli_query($con,$q1);
while($r = mysqli_fetch_array($get_q1)){
    $offs = $r["offers"];
}
$explode_off = explode(",",$offs);
if(in_array($off,$explode_off)){
    echo "<h1>This Offer has already been added...</h1>";
    header("refresh:4;url=../Product.php?display=".$pid);
    mysqli_close($con);
    exit; 
}else{
    $offs .= $off.",";
}
    
$q2 = "UPDATE product SET offers = '$offs' WHERE product_id = '$pid'";
if(mysqli_query($con,$q2)){
    echo "<h1>Offer Successfully added...</h1>";
    header("refresh:2;url=../Product.php?display=".$pid); 
}else{
    echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
    header("refresh:4;url=../Product.php?display=".$pid); 
}
mysqli_close($con);

?>