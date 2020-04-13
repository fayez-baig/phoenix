<?php 
    session_start();
    if (!isset($_SESSION['student']) && !isset($_SESSION['user']) ) {
        header("location:login.php");
        exit();       
    }
?>