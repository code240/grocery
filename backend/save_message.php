<?php
    if(!isset($_POST['name'])){
        header("location:../Home");
        exit;
    }
    include "database.php";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $q = "INSERT INTO msg (user_name,user_email,msg_subject,user_message) VALUES ('$name','$email','$subject','$message')";
    
    if(!mysqli_query($con,$q)){
        echo "<h3>Message Save Error.<br> Redirecting...</h3>";
        header("refresh:2.5;url=../Home");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Save - Daily Buy Mart</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/save_message.css">
</head>
<body>  
    <h1>
        Your Message has been saved successfully.
    </h1>
    <div class="loading-div">

    </div>
    <a href="../Home">
        <button class="btn btn-primary btn-home">Back To Home</button>
    </a>
    <a href="../Contact">
        <button class="btn btn-link btn-home">Contact Page</button>
    </a>

</body>
</html>