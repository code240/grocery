<?php
    session_start();
    if(!isset($_SESSION["loginstatus"])){
        header( "refresh:0;url=../Login"); 
    }else{
        header( "refresh:0;url=../Pannel-Home");
        session_unset();
        session_destroy(); 
    }
?>