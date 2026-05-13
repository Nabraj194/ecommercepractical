<?php
include 'php/config.php';

$id = $_GET['id'];

$product_query = mysqli_query($conn,"SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($product_query);

if(!$product){
    die("Product Not Found");
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $product['name']; ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div style="
width:80%;
margin:50px auto;
display:flex;
gap:40px;
align-items:center;
">

    <img src="images/<?php echo $product['image']; ?>" style="
    width:400px;
    border-radius:15px;
    ">

    <div>

        <h1><?php echo $product['name']; ?></h1>

        <h2>Rs. <?php echo $product['price']; ?></h2>

        <?php if($product['stock'] > 0){ ?>
            <p style="color:green;font-weight:bold;">In Stock</p>
        <?php } else { ?>
            <p style="color:red;font-weight:bold;">Out of Stock</p>
        <?php } ?>

        <p><?php echo $product['description']; ?></p>

        <?php if($product['stock'] > 0){ ?>

        <form action="php/add_to_cart.php" method="POST">

            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

            <input type="number" 
            name="quantity" 
            value="1" 
            min="1" 
            max="<?php echo $product['stock']; ?>"
            style="
            width:70px;
            padding:8px;
            margin-bottom:10px;
            "><br><br>

            <button type="submit">Add To Cart</button>

        </form>

        <?php } else { ?>

            <button disabled>Out of Stock</button>

        <?php } ?>

    </div>

</div>


<hr style="margin:50px 0;">

<h2 style="text-align:center;">Related Products</h2>

<div style="
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
width:90%;
margin:30px auto;
">

<?php
$category = $product['category'];

$related_query = mysqli_query($conn,"
SELECT * FROM products 
WHERE category='$category' 
AND id != '$id'
LIMIT 4
");

while($related = mysqli_fetch_assoc($related_query)){
?>

<div style="
border:1px solid #ddd;
padding:15px;
border-radius:10px;
text-align:center;
">

<a href="product.php?id=<?php echo $related['id']; ?>" style="text-decoration:none;color:black;">

    <img src="images/<?php echo $related['image']; ?>" width="100%">

    <h4><?php echo $related['name']; ?></h4>

    <p>Rs. <?php echo $related['price']; ?></p>

</a>

</div>

<?php } ?>

</div>


<hr style="margin:50px 0;">

<h2>Leave a Review</h2>

<form action="php/add_review.php" method="POST">

    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

    <input type="text" name="user_name" placeholder="Your Name" required><br><br>

    <select name="rating" required>
        <option value="">Select Rating</option>
        <option value="5">★★★★★</option>
        <option value="4">★★★★</option>
        <option value="3">★★★</option>
        <option value="2">★★</option>
        <option value="1">★</option>
    </select><br><br>

    <textarea name="comment" placeholder="Write your review"></textarea><br><br>

    <button type="submit">Submit Review</button>

</form>


<hr style="margin:50px 0;">

<h2>Customer Reviews</h2>

<?php
$review_query = mysqli_query($conn,"
SELECT * FROM reviews 
WHERE product_id='$id' 
ORDER BY created_at DESC
");

while($review = mysqli_fetch_assoc($review_query)){
?>

<div style="
border:1px solid #ddd;
padding:15px;
margin:15px 0;
border-radius:10px;
">

    <h4><?php echo $review['user_name']; ?></h4>

    <p>Rating: <?php echo $review['rating']; ?>/5</p>

    <p><?php echo $review['comment']; ?></p>

    <small><?php echo $review['created_at']; ?></small>

</div>

<?php } ?>

</body>
</html>