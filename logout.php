<?php 
ob_start();
session_start();
include 'admin/inc/config.php';
unset($_SESSION['customer']);
header("location: ".BASE_URL.'login.php'); 
?>
<style>
    body{
        background-color: #aa7a76;
    }
</style>