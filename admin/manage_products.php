<?php
include '../php/config.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    die("Access Denied");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h1 style="text-align:center;">Admin Dashboard</h1>

<div style="text-align:center; margin-top:30px;">

<a href="admin_order.php">📦 Manage Orders</a><br><br>

<a href="manage_products.php">🛒 Manage Products</a><br><br>

<a href="../index.php">🏠 Go to Website</a>

</div>

</body>
</html>