<?php
include 'config.php';

$product_id = $_POST['product_id'];
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
$session_id = session_id();

/* CHECK STOCK */
$product_query = mysqli_query($conn,"SELECT stock FROM products WHERE id='$product_id'");
$product = mysqli_fetch_assoc($product_query);

if($product['stock'] <= 0){
    die("Out of Stock");
}

if($quantity > $product['stock']){
    die("Requested quantity exceeds available stock");
}

/* CHECK EXISTING CART ITEM */
$check = mysqli_query($conn,"
SELECT * FROM cart 
WHERE product_id='$product_id' 
AND session_id='$session_id'
");

if(mysqli_num_rows($check) > 0){

    $update_query = "
    UPDATE cart 
    SET quantity = quantity + $quantity
    WHERE product_id='$product_id'
    AND session_id='$session_id'
    ";

    mysqli_query($conn,$update_query);

}else{

    $insert_query = "
    INSERT INTO cart(product_id,quantity,session_id)
    VALUES('$product_id','$quantity','$session_id')
    ";

    mysqli_query($conn,$insert_query);
}

header("Location: ../index.php");
exit();
?>