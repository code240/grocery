<?php
    include "database.php";
    $q1 = "SELECT * FROM product";
    $get_product = mysqli_query($con,$q1);
    $product_count_2 = mysqli_num_rows($get_product);


    $q2 = "SELECT * FROM offer";
    $get_offer = mysqli_query($con,$q2);
    $offer_count_2 = mysqli_num_rows($get_offer);

    $q3 = "SELECT * FROM category";
    $get_cat = mysqli_query($con,$q3);
    $cat_count_2 = mysqli_num_rows($get_cat);
    
    mysqli_close($con);
?>