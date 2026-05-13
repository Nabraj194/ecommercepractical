<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div style="
width:50%;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
">

<h2>Checkout Form</h2>

<form action="place_order.php" method="POST">

<input type="text" name="fullname" placeholder="Full Name" required><br><br>

<input type="email" name="email" placeholder="Email Address" required><br><br>

<input type="text" name="address" placeholder="Shipping Address" required><br><br>

<input type="text" name="phone" placeholder="Phone Number" required><br><br>

<button type="submit">Place Order</button>

</form>

</div>

</body>
</html>