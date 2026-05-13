<?php
include '../php/config.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

/* ADMIN CHECK */
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    die("Access Denied");
}

/* COUNTS */
$total_users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM users"))['total'];
$total_products = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM products"))['total'];
$total_reviews = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM reviews"))['total'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM orders"))['total'];

/* CATEGORY (SUPPLY) */
$category_data = mysqli_query($conn,"
SELECT category, COUNT(*) as total FROM products GROUP BY category
");
$categories = [];
$counts = [];
while($row = mysqli_fetch_assoc($category_data)){
    $categories[] = $row['category'];
    $counts[] = $row['total'];
}

/* ORDERS (DEMAND) */
$order_data = mysqli_query($conn,"
SELECT DATE(created_at) as day, COUNT(*) as total FROM orders GROUP BY day
");
$days = [];
$order_counts = [];
while($row = mysqli_fetch_assoc($order_data)){
    $days[] = $row['day'];
    $order_counts[] = $row['total'];
}

/* REVENUE */
$revenue_data = mysqli_query($conn,"
SELECT DATE(created_at) as day, SUM(total_price) as total FROM orders GROUP BY day
");
$rev_days = [];
$revenues = [];
while($row = mysqli_fetch_assoc($revenue_data)){
    $rev_days[] = $row['day'];
    $revenues[] = $row['total'];
}

/* TOP PRODUCTS */
$top_products = mysqli_query($conn,"
SELECT product_id, COUNT(*) as total FROM cart 
GROUP BY product_id ORDER BY total DESC LIMIT 5
");

/* REPORTED PRODUCTS */
$reports = mysqli_query($conn,"
SELECT product_id, COUNT(*) as total 
FROM reports GROUP BY product_id ORDER BY total DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="dashboard">

<h1>Admin Dashboard</h1>

<!-- STATS -->
<div class="cards">
    <div class="card"><h2><?php echo $total_users; ?></h2><p>Users</p></div>
    <div class="card"><h2><?php echo $total_products; ?></h2><p>Products</p></div>
    <div class="card"><h2><?php echo $total_orders; ?></h2><p>Orders</p></div>
    <div class="card"><h2><?php echo $total_reviews; ?></h2><p>Reviews</p></div>
</div>

<!-- SUPPLY CHART -->
<h2 style="text-align:center;">Supply (Products by Category)</h2>
<canvas id="supplyChart" style="max-width:700px;margin:30px auto;"></canvas>

<!-- DEMAND CHART -->
<h2 style="text-align:center;">Demand (Orders)</h2>
<canvas id="demandChart" style="max-width:700px;margin:30px auto;"></canvas>

<!-- REVENUE -->
<h2 style="text-align:center;">Revenue</h2>
<canvas id="revenueChart" style="max-width:700px;margin:30px auto;"></canvas>

<!-- NAV -->
<!-- NAV -->
<div class="admin-links">
    <a href="admin_order.php">📦 Orders</a>
    <a href="manage_products.php">🛒 Products</a>
    <a href="admin_messages.php">📩 Messages</a>
</div>

<!-- TOP PRODUCTS -->
<h2>Top Selling Products</h2>
<?php while($t = mysqli_fetch_assoc($top_products)){ 
    $pid = $t['product_id'];
    $p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM products WHERE id='$pid'"));
?>
<div>
    <b><?php echo $p['name']; ?></b> (Sold: <?php echo $t['total']; ?>)
</div>
<?php } ?>

<!-- REPORTED PRODUCTS -->
<h2>Reported Products</h2>
<?php while($r = mysqli_fetch_assoc($reports)){ 
    $pid = $r['product_id'];
    $p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM products WHERE id='$pid'"));
?>
<div>
    <?php echo $p['name']; ?> (Reports: <?php echo $r['total']; ?>)
    <a href="delete_product.php?id=<?php echo $pid; ?>" style="color:red;">Remove</a>
</div>
<?php } ?>

<!-- PRODUCT LIST -->
<h2>Manage Products</h2>
<div class="product-grid">

<?php
$products = mysqli_query($conn,"SELECT * FROM products");
while($p = mysqli_fetch_assoc($products)){
?>
<div class="product-card">
    <h3><?php echo $p['name']; ?></h3>
    <p>Rs. <?php echo $p['price']; ?></p>
    <p>Stock: <?php echo $p['stock']; ?></p>
    <a href="delete_product.php?id=<?php echo $p['id']; ?>" class="delete-btn">Delete</a>
</div>
<?php } ?>

</div>

</div>

<!-- CHARTS -->
<script>
new Chart(document.getElementById("supplyChart"), {
    type: "bar",
    data: {
        labels: <?php echo json_encode($categories); ?>,
        datasets: [{ label: "Products", data: <?php echo json_encode($counts); ?> }]
    }
});

new Chart(document.getElementById("demandChart"), {
    type: "line",
    data: {
        labels: <?php echo json_encode($days); ?>,
        datasets: [{ label: "Orders", data: <?php echo json_encode($order_counts); ?> }]
    }
});

new Chart(document.getElementById("revenueChart"), {
    type: "bar",
    data: {
        labels: <?php echo json_encode($rev_days); ?>,
        datasets: [{ label: "Revenue", data: <?php echo json_encode($revenues); ?> }]
    }
});
</script>

</body>
</html>