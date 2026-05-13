<?php
include '../php/config.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

/* ADMIN CHECK */
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    die("Access Denied");
}

/* VALIDATE ID */
if(!isset($_GET['id'])){
    die("Invalid Request");
}

$id = intval($_GET['id']); // safer

/* DELETE PRODUCT */
mysqli_query($conn,"DELETE FROM products WHERE id='$id'");

/* REDIRECT */
header("Location: manage_products.php");
exit();
?>