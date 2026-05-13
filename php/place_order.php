<?php
include 'config.php';

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$prices = [
    1 => 850,
    2 => 2500,
    3 => 1500,
    4 => 1200
];

$session_id = session_id();

$cart_query = mysqli_query($conn,"SELECT * FROM cart WHERE session_id='$session_id'");

$total = 0;

while($row = mysqli_fetch_assoc($cart_query)){

    $product_price = $prices[$row['product_id']];

    $total += $product_price * $row['quantity'];
}

mysqli_query($conn,"INSERT INTO orders 
(fullname,email,address,phone,total_price)
VALUES
('$fullname','$email','$address','$phone','$total')");

mysqli_query($conn,"DELETE FROM cart WHERE session_id='$session_id'");

header("Location: success.php");
exit();
?>