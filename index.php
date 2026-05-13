<?php
include 'php/config.php';

$product_query = mysqli_query($conn, "SELECT * FROM products");
    $selected_category = "";

    if(isset($_GET['category'])){
       $selected_category = $_GET['category'];
}

    $count_query = mysqli_query($conn,"SELECT SUM(quantity) as total FROM cart 
    WHERE session_id='".session_id()."'");

    $count = mysqli_fetch_assoc($count_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Handmade Haven</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- 🔥 ADD LOADING SCREEN HERE (TOP OF PAGE CONTENT) -->
<div id="loading-screen">
    <div class="loader"></div>
    <h2>Searching Products...</h2>
</div>

<!-- PREMIUM NAVBAR -->
<nav class="navbar">
    <div class="logo">
        <img src="whh.jpeg">
        <h2>ArtNest</h2>
    </div>

<ul class="nav-menu">
    <li><a href="#">Home</a></li>

  <li class="dropdown">
    <a href="#category-section">Category</a>

    <ul class="dropdown-menu">
        <li><a href="category.php?category=handmade">Handmade</a></li>
        <li><a href="category.php?category=paintings">Paintings</a></li>
        <li><a href="category.php?category=ceramics">Ceramics</a></li>
        <li><a href="category.php?category=decor">Decor</a></li>
    </ul>
</li>
 <li><a href="php/about.php">About</a></li>
<li><a href="php/contact.php">Contact</a></li>
    
</ul>

    <div class="nav-btns">
    <a href="login.html">Login</a>
    <a href="register.html">Register</a>
        <a href="cart.php" class="cart-icon">
            🛒 <?php echo $count['total'] ?? 0; ?>
        </a>
    </div>
</nav>

<?php
$search = trim($_GET['search'] ?? '');
?>

<?php if ($search != '') { ?>

    <!-- ================= SEARCH PAGE ================= -->

    <?php
    $search_safe = mysqli_real_escape_string($conn, $search);

    $product_query = mysqli_query($conn, "
        SELECT * FROM products
        WHERE name LIKE '%$search_safe%'
           OR category LIKE '%$search_safe%'
           OR description LIKE '%$search_safe%'
    ");
    ?>

    <section class="products">
        <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>

        <div class="product-grid">
            <?php if (mysqli_num_rows($product_query) > 0) { ?>
                <?php while ($p = mysqli_fetch_assoc($product_query)) { ?>
                    <div class="product-card">
                        <a href="product.php?id=<?php echo $p['id']; ?>">
                            <img src="images/<?php echo $p['image']; ?>">
                            <h4><?php echo $p['name']; ?></h4>
                            <p>Rs. <?php echo $p['price']; ?></p>
                        </a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p style="text-align:center; font-size:20px; color:red;">
                    No products found.
                </p>
            <?php } ?>
        </div>

        <div style="text-align:center; margin-top:30px;">
            <a href="index.php"
               style="padding:10px 20px; background:black; color:white; border-radius:10px; text-decoration:none;">
               Back to Home
            </a>
        </div>
    </section>

<?php } else { ?>

    <!-- ================= HOME PAGE ================= -->

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-overlay">
            <h1>Discover Handmade Beauty</h1>
            <p>Unique Craftsmanship, Beautiful Art, Elegant Decor</p>

            <div class="search-box">
                <form method="GET" action="index.php" style="display:flex; width:100%;">
                    <input type="text" name="search" placeholder="Search products...">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="categories" id="category-section">
        <!-- Y<!-- CATEGORIES -->
<section class="categories" id="category-section">
    <h2>Explore Categories</h2>

    <div class="cat-container">

        <a href="category.php?category=handmade">
            <div class="cat-box">
                <img src="land.jpg">
                <h3>Handmade</h3>
            </div>
        </a>

        <a href="category.php?category=paintings">
            <div class="cat-box">
                <img src="titel.jpg">
                <h3>Paintings</h3>
            </div>
        </a>

        <a href="category.php?category=ceramics">
            <div class="cat-box">
                <img src="earth.webp">
                <h3>Ceramics</h3>
            </div>
        </a>

        <a href="category.php?category=decor">
            <div class="cat-box">
                <img src="pro.webp">
                <h3>Decor</h3>
            </div>
        </a>

    </div>
    </section>

    <!-- TRENDING PRODUCTS -->
    <section class="products">
        <h2>Trending Products</h2>

        <?php
        $product_query = mysqli_query($conn, "
            SELECT * FROM products
            ORDER BY sold_count DESC
            LIMIT 8
        ");
        ?>

        <div class="product-grid">
            <?php while ($p = mysqli_fetch_assoc($product_query)) { ?>
                <div class="product-card">
                    <a href="product.php?id=<?php echo $p['id']; ?>">
                        <img src="images/<?php echo $p['image']; ?>">
                        <h4><?php echo $p['name']; ?></h4>
                        <p>Rs. <?php echo $p['price']; ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

<?php } ?>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-box">
            <h3>SOCIAL MEDIA</h3>
            <ul>
                <li><img src="fb.jpg"><a href="#">Facebook</a></li>
                <li><img src="inst.webp"><a href="#">Instagram</a></li>
                <li><img src="R.jpg"><a href="#">Tiktok</a></li>
            </ul>
        </div>
        <div class="footer-box">
            <h3>SECURE PAYMENT</h3>
            <div class="new-foot"><img src="es.png" alt=""></div>
        </div>
        <div class="footer-box">
            <h3>CONTACT US</h3>
            <p>artnest@gmail.com</p>
            <p>Nepalgunj, Banke</p>
            <p>Whatsapp/Viber: <strong>9812345670</strong></p>
        </div>
        <div class="footer-box">
            <h3>INFORMATION</h3>
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Terms and Conditions</a></li>
                <li><a href="#">Refund and Return Policy</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 ArtNest. All Rights Reserved.</p>
    </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>
