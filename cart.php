<?php
include 'php/config.php';


$session_id = session_id();

$query = mysqli_query($conn,"SELECT * FROM cart WHERE session_id='$session_id'");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2 style="text-align:center; margin-top:50px;">Your Shopping Cart</h2>

<div style="width:80%; margin:auto;">

<?php while($row=mysqli_fetch_assoc($query)){ 

$product_id = $row['product_id'];

$product_query = mysqli_query($conn,"SELECT * FROM products WHERE id='$product_id'");

$product = mysqli_fetch_assoc($product_query);
if(!$product){
    continue;
}

$subtotal = $product['price'] * $row['quantity'];

$total += $subtotal;
?>


<div style="background:white;padding:20px;margin:20px;border-radius:10px;display:flex;align-items:center;gap:20px;">

    <img src="images/<?php echo $product['image']; ?>" style="width:120px;height:120px;object-fit:cover;border-radius:10px;">

    <div>

        <h3><?php echo $product['name']; ?></h3>

        <p>Price: Rs. <?php echo $product['price']; ?></p>

        <p>
        Quantity: 

        <a href="php/update_quantity.php?id=<?php echo $row['id']; ?>&action=decrease">
            <button>-</button>
        </a>

        <?php echo $row['quantity']; ?>

        <a href="php/update_quantity.php?id=<?php echo $row['id']; ?>&action=increase">
            <button>+</button>
        </a>
        </p>

        <p>Subtotal: Rs. <?php echo $subtotal; ?></p>

        <a href="php/remove_cart.php?id=<?php echo $row['id']; ?>">
            <button class="remove-btn">Remove</button>
        </a>

    </div>

</div>

<?php } ?>

<div style="
background:white;
padding:20px;
margin:20px;
border-radius:10px;
text-align:center;
">

    <h2>Total: Rs. <?php echo $total; ?></h2>

    <a href="php/checkout.php">
    <button style="
    padding:15px 30px;
    background:green;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
    ">
        Proceed to Checkout
    </button>
</a>

</div>

</div>

</body>
</html>