<?php
    include "database.php";

	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

    if($name=="" || $email=="" || $subject=="" || $message==""){
        echo "Please fill all the fields";
        exit;
    }
    $q = "INSERT INTO msg (user_name,user_email,msg_subject,user_message) VALUES ('$name','$email','$subject','$message')";
    if(mysqli_query($con,$q)){
        echo "yes";
    }else{
        echo "Failed to add data in database";
    }
?>