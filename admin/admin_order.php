<?php
include '../php/config.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}



$query = mysqli_query($conn,"SELECT * FROM orders");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Orders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2 style="text-align:center;margin:30px;">Customer Orders</h2>

<div style="width:90%;margin:auto;">

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<div style="
background:white;
padding:20px;
margin:20px;
border-radius:10px;
">

<h3><?php echo $row['fullname']; ?></h3>

<p>Email: <?php echo $row['email']; ?></p>

<p>Phone: <?php echo $row['phone']; ?></p>

<p>Address: <?php echo $row['address']; ?></p>

<p>Total Paid: Rs. <?php echo $row['total_price']; ?></p>

<p>Date: <?php echo $row['created_at']; ?></p>

</div>

<?php } ?>

</div>

</body>
</html>