<?php 
    session_start();
    if (!isset($_SESSION['parent']) && !isset($_SESSION['userP']) ) {
        header("location:login.php");
        exit();       
    }
?>