<?php
include 'php/config.php';

$category = $_GET['category'];

$count_query = mysqli_query($conn,"SELECT SUM(quantity) as total FROM cart 
WHERE session_id='".session_id()."'");

$count = mysqli_fetch_assoc($count_query);

$product_query = mysqli_query($conn,"SELECT * FROM products WHERE category='$category'");
?>
<?php
$category_data = mysqli_query($conn,"
SELECT category, COUNT(*) as total 
FROM products 
GROUP BY category
");

$categories = [];
$counts = [];

while($row = mysqli_fetch_assoc($category_data)){
    $categories[] = $row['category'];
    $counts[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo ucfirst($category); ?> Products</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">

<div class="logo">
<img src="whh.jpeg">
<h2>ArtNest</h2>
</div>

<div class="nav-btns">
<a href="index.php">Home</a>

<a href="cart.php">
🛒 <?php echo $count['total'] ?? 0; ?>
</a>
</div>

</nav>


<section class="products" style="margin-top:120px;">

<h2><?php echo ucfirst($category); ?> Collection</h2>

<div class="product-grid">

<?php while($p = mysqli_fetch_assoc($product_query)){ ?>

<div class="product-card">

<a href="product.php?id=<?php echo $p['id']; ?>" style="text-decoration:none; color:inherit;">

    <img src="images/<?php echo $p['image']; ?>">

    <h4><?php echo $p['name']; ?></h4>

    <p>Rs. <?php echo $p['price']; ?></p>

</a>

<form action="php/add_to_cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
    <button type="submit">Add to cart</button>
</form>

</div>

<?php } ?>

</div>

</section>

</body>
</html>