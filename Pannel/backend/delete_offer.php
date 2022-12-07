<?php
    $do = $_GET["do"];
    include "database.php";
    if($do == "mix"){
        echo "This offer cannot be deleted";
        mysqli_close($con);
        exit;
    }
    $q1 = "SELECT * FROM product WHERE offers LIKE '%$do%'";
    $get_q1 = mysqli_query($con,$q1);
    if(mysqli_num_rows($get_q1)>0){
        $i=0;
        while($r = mysqli_fetch_assoc($get_q1)){
            $off[$i] = $r["offers"];
            $remove = $do.",";
            $x = str_replace($remove,"",$off[$i]);
            $pid = $r["product_id"];
            $q2 = "UPDATE product SET offers = '$x' WHERE product_id = '$pid'";
            mysqli_query($con,$q2);
        }
    }


    // exit;
    $q3 = "DELETE FROM offer WHERE offer_code = '$do'";
    if(mysqli_query($con,$q3)){
        echo "<h1>Offer delete successfully.<br>Redirecting....</h1>";
        header("refresh:2;url=../Offer");
    }else{
        echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
        header("refresh:4;url=../Offer");  
    }

    mysqli_close($con);
?>