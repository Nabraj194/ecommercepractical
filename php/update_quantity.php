<?php
include 'config.php';

$id = $_GET['id'];
$action = $_GET['action'];

if($action == "increase"){

    mysqli_query($conn,"UPDATE cart 
    SET quantity = quantity + 1 
    WHERE id='$id'");

}

if($action == "decrease"){

    $check = mysqli_query($conn,"SELECT * FROM cart WHERE id='$id'");
    $row = mysqli_fetch_assoc($check);

    if($row['quantity'] > 1){

        mysqli_query($conn,"UPDATE cart 
        SET quantity = quantity - 1 
        WHERE id='$id'");

    }else{

        mysqli_query($conn,"DELETE FROM cart 
        WHERE id='$id'");

    }
}

header("Location: ../cart.php");
?>