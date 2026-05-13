<?php
include '../php/config.php';

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category = $_POST['category'];
$stock = $_POST['stock'];

$seller_id = $_SESSION['user']['id'];

/* IMAGE UPLOAD */
$image = $_FILES['image']['name'];
$temp_name = $_FILES['image']['tmp_name'];

move_uploaded_file($temp_name, "../images/".$image);

/* INSERT PRODUCT */
$sql = "INSERT INTO products(name,price,image,description,category,seller_id,stock)
VALUES('$name','$price','$image','$description','$category','$seller_id','$stock')";

if(mysqli_query($conn,$sql)){
    echo "Product Added Successfully";
}else{
    echo "Error: " . mysqli_error($conn);
}
?>