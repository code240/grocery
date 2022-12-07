<?php
    $do = $_GET["do"];
    include "database.php";
    // $do_check = ",".$do.",";
    $q1 = "SELECT * FROM product WHERE cats LIKE '%$do%'";
    $get_q1 = mysqli_query($con,$q1);
    if(mysqli_num_rows($get_q1)>0){
        // $i=0;
        // while($r = mysqli_fetch_assoc($get_q1)){
        //     $off[$i] = $r["offers"];
        //     $remove = $do.",";
        //     $x = str_replace($remove,"",$off[$i]);
        //     $pid = $r["product_id"];
        //     $q2 = "UPDATE product SET offers = '$x' WHERE product_id = '$pid'";
        //     mysqli_query($con,$q2);
        // }
        echo "<center><h1>The category you want to delete is not empty.</h1><br> <h3>The category can be deleted only if it is not containing any product.</h3></center>";
        exit;
    }


    $q3 = "DELETE FROM category WHERE cat_code = '$do'";
    if(mysqli_query($con,$q3)){
        echo "<h1>Category delete successfully.<br>Redirecting....</h1>";
        header("refresh:2;url=../Category");
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header("refresh:4;url=../Category");  
    }

    mysqli_close($con);



?>