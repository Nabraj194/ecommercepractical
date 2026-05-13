<?php
include 'config.php';

$product_id = $_POST['product_id'];
$user_name = $_POST['user_name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

mysqli_query($conn,"
INSERT INTO reviews(product_id,user_name,rating,comment)
VALUES('$product_id','$user_name','$rating','$comment')
");

header("Location: ../product.php?id=".$product_id);
?>