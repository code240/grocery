<?php
    if(!isset($_POST["brandname"]) || !isset($_POST["productname"])){
        echo "error";
        exit;
    }
    $brandname = $_POST["brandname"];
    $itemname = $_POST["productname"];
    $mrp = $_POST["mrp"];
    $sell = $_POST["sell"];
    $quantity = $_POST["quantity"];
    $rating = $_POST["rating"];
    $des = $_POST["productdes"];
    $cat = $_POST["cat"];
    $offer = $_POST["offer"];
    if($offer != "mix"){
        $offer = "mix,".$offer;
    }
    include "database.php";
    if(!is_numeric($mrp) || !is_numeric($sell)){
        echo "Mrp and selling price must be numeric";
        exit;
    }
    if((int)$sell>(int)$mrp){
        echo "Selling price cannot be greater than mrp";
        exit;
    }
    $x = (100-(($sell/$mrp)*100));
    $discount =  round($x);

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
    $pid = $combine.$time;
    $pcode = $alpha[$r4].$alpha2[$r8].$time;

    $offer = $offer.",";
    $cat = $cat.",";
    $dpid = "Daily_Buy_Mart_Product_image_".$time;
    $desid = "Description_".$alpha[$r2].$time;
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

    $q1 = "INSERT INTO product (item_name,brand,rating,product_id,mrp,selling_price,discount,quantity,pin,delete_status,product_code,cats,offers) VALUES ('$itemname','$brandname','$rating','$pid','$mrp','$sell','$discount','$quantity','0','0','$pcode','$cat','$offer')";
    if(mysqli_query($con,$q1)){
        if($des != ""){
            $q3 = "INSERT INTO specification (description,data_code,product_id) VALUES ('$des','$desid','$pid')";
            mysqli_query($con,$q3);
        }
        $destination = "../../media/miniProducts/";
        $imagename = $_FILES['img']['name'];
        $imageTempname = $_FILES['img']['tmp_name'];
        $target_file = $destination.$imagename;
        if(move_uploaded_file($imageTempname,$target_file)){
            $newname = getnewname($imagename);
            $filePath = $destination.$imagename;    
            $destinationFilePath = $destination.$newname;
            if(rename($filePath, $destinationFilePath)){
                $q2 = "INSERT INTO media (image_name,image_code,product_id,active_image) VALUES ('$newname','$dpid','$pid','1')";
                if(mysqli_query($con,$q2)){
                    echo "<h1>Product Successfully Added..</h1>";
                    header("refresh:2;url=../Product.php?display=".$pid); 
                }else{
                    echo "Something went wrong";
                    exit;
                }
            }else{
                echo "Something went wrong";
                exit;
            }
                
        }else{
            echo "Something went wrong";
            exit;
        }

    }else{
        echo "Something went wrong";
    }
?>