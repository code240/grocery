<?php
    if(!isset($_POST["pid"])){
        echo "error";
        exit;
    }
    // get new name function
    function getnewname($getname){
        $extension_array = explode(".",$getname);
        $array_len = count($extension_array);
        $extension = $extension_array[$array_len-1];
        date_default_timezone_set('Asia/Kolkata');
        $time = date("d_m_y_h_i_s_");
        $explode = explode(".",microtime());
        $microtime = $explode[1];
        $imagename = "Daily_Buy_Mart_Product_image".$time.$microtime.".".$extension;
        return $imagename;
    }
    // get new name function over
    include("database.php");
    $pid = $_POST["pid"];
    date_default_timezone_set('Asia/Kolkata');
    $destination = "../../media/miniProducts/";
    $imagename = $_FILES['product_dp']['name'];
    $imageTempname = $_FILES['product_dp']['tmp_name'];
    $target_file = $destination.$imagename;
    if(move_uploaded_file($imageTempname,$target_file)){
        $newname = getnewname($imagename);
        $filePath = $destination.$imagename;    
        $destinationFilePath = $destination.$newname;
        if(rename($filePath, $destinationFilePath)){
            $newname_arr = explode(".",$newname);
            $dpid = $newname_arr[0];
            $q1 = "SELECT * FROM media WHERE (active_image = '1') AND (product_id = '$pid')";
            $pined_data = mysqli_query($con,$q1);
            $pin_count = mysqli_num_rows($pined_data);
            if($pin_count == 0){
                $pin='1';
            }else{
                $pin='0';
            }
            $q2 = "INSERT INTO media (image_name,image_code,product_id,active_image) VALUES ('$newname','$dpid','$pid','$pin')";
            if(mysqli_query($con,$q2)){
                echo "<h1>Successfully upload...</h1>";
                header("refresh:2;url=../Product.php?display=".$pid); 
            }else{
                echo "<h1>Something went wrong! Try again<br>Redirecting....</h1>";
                header("refresh:4;url=../Product.php?display=".$pid); 
            }
        }else{
            echo "<h1>Something went wrong!! Try again<br>Redirecting....</h1>";
            header("refresh:4;url=../Product.php?display=".$pid); 
        }
    }else{
        echo "<h1>Something went wrong!!! Try again<br>Redirecting....</h1>";
        header( "refresh:4;url=../Product.php?display=".$pid);
    }


?>