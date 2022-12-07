<?php
    include "database.php";
    $q1 = "SELECT * FROM basic_data";
    $get_basic = mysqli_query($con,$q1);
    while($r = mysqli_fetch_array($get_basic)){
        $shopName = $r["shop_name"];
        $ShortAddress = $r["short_address"];
        $ShopAdrress = $r["shop_address"];
        $mobile = $r["mobile"];
        $email = $r["email_id"];
        $map = $r["map_url"];
        $embed_map = $r["embed_map"];
        $upto = $r["upto_off"];
    }
?>