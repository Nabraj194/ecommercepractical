<?php
$conn = mysqli_connect("localhost", "root", "", "ecommerce_store");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>