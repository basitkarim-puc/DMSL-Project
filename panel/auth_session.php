<?php
    session_start();
    if(!isset($_SESSION["admin_email"])) {
        header("Location: login.php");
        exit();
    }
?>