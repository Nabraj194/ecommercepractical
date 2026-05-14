<?php
include 'php/config.php';

session_start();

$selected_category = "";

if(isset($_GET['category'])){
    $selected_category = $_GET['category'];
}

$search = trim($_GET['search'] ?? '');

/* CART COUNT */
$count_query = mysqli_query($conn,"
    SELECT SUM(quantity) as total 
    FROM cart 
    WHERE session_id='".session_id()."'
");

$count = mysqli_fetch_assoc($count_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtNest</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f8f5ef;
        }

        /* NAVBAR */

        .navbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:85px;

            display:flex;
            justify-content:space-between;
            align-items:center;

            padding:0 60px;

            background:rgba(70,50,40,0.95);

            z-index:1000;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .logo img{
            width:60px;
            height:60px;
            border-radius:50%;
            object-fit:cover;
            border:3px solid #d9a441;
        }

        .logo h2{
            color:white;
            font-size:40px;
        }

        /* NAV MENU */

.nav-menu{

    display:flex;

    align-items:center;

    gap:35px;

    list-style:none;
}

.nav-menu li{
    position:relative;
}

.nav-menu li a{

    color:white;

    text-decoration:none;

    font-size:20px;

    padding:10px;

    display:block;
}

/* DROPDOWN */

.dropdown-menu{

    display:none;

    position:absolute;

    top:45px;

    left:0;

    min-width:220px;

    background:white;

    border-radius:10px;

    box-shadow:0 5px 15px rgba(0,0,0,0.15);

    z-index:9999;

    list-style:none;

    padding:0;

    margin:0;

    flex-direction:column;
}

.dropdown-menu li a{

    color:#333 !important;

    padding:14px 18px;

    display:block;

    font-size:16px;

    transition:0.3s;
    
}

.dropdown-menu li a:hover{

    background:#f3f3f3;

    color:#d97b49 !important;
}

/* IMPORTANT */


        .cart-icon{
            font-size:20px;
        }

        /* HERO */

        .hero{
            height:100vh;

            background:
            linear-gradient(rgba(255,255,255,0.4),rgba(255,255,255,0.4)),
            url('hero.jpg');

            background-size:cover;
            background-position:center;

            display:flex;
            justify-content:center;
            align-items:center;

            text-align:center;

            padding-top:80px;
        }

        .hero-overlay h1{
            font-size:75px;
            color:#3c2415;
            margin-bottom:20px;
        }

        .hero-overlay p{
            font-size:30px;
            color:#3c2415;
            margin-bottom:40px;
        }

        /* SEARCH BAR */

        .search-box{
            display:flex;
            justify-content:center;
        }

        .search-box form{
            width:700px;

            background:rgba(255,255,255,0.25);

            padding:10px;

            border-radius:20px;

            display:flex;
            align-items:center;

            backdrop-filter:blur(5px);
        }

        .search-box input{
            flex:1;

            padding:18px;

            border:none;
            outline:none;

            border-radius:12px;

            font-size:18px;

            background:white;
            color:black;
        }

        .search-box input::placeholder{
            color:#777;
        }

        .search-box button{
            margin-left:10px;

            padding:18px 35px;

            border:none;

            border-radius:12px;

            background:#d97b49;

            color:white;

            font-size:18px;

            cursor:pointer;

            transition:0.3s;
        }

        .search-box button:hover{
            background:#b85f2f;
        }

        /* CATEGORY */

        .categories{
            padding:80px 60px;
            background:white;
        }

        .categories h2{
            text-align:center;
            font-size:45px;
            margin-bottom:40px;
            color:#3c2415;
        }

        .cat-container{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:30px;
        }

        .cat-box{
            background:white;
            border-radius:20px;
            overflow:hidden;

            box-shadow:0 5px 15px rgba(0,0,0,0.1);

            transition:0.3s;
        }

        .cat-box:hover{
            transform:translateY(-5px);
        }

        .cat-box img{
            width:100%;
            height:250px;
            object-fit:cover;
        }

        .cat-box h3{
            text-align:center;
            padding:20px;
            color:#3c2415;
            font-size:28px;
        }

        .cat-container a{
            text-decoration:none;
        }

        /* PRODUCTS */

        .products{
            padding:80px 60px;
        }

        .products h2{
            text-align:center;
            font-size:45px;
            margin-bottom:40px;
            color:#3c2415;
        }

        .product-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:30px;
        }

        .product-card{
            background:white;
            border-radius:20px;
            overflow:hidden;

            box-shadow:0 5px 15px rgba(0,0,0,0.1);

            transition:0.3s;
        }

        .product-card:hover{
            transform:translateY(-5px);
        }

        .product-card img{
            width:100%;
            height:250px;
            object-fit:cover;
        }

        .product-card h4{
            padding:15px;
            color:#3c2415;
            font-size:22px;
        }

        .product-card p{
            padding:0 15px 20px;
            color:#d97b49;
            font-size:20px;
            font-weight:bold;
        }

        .product-card a{
            text-decoration:none;
        }

        /* FOOTER */

    </style>
</head>

<body>

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        <img src="whh.jpeg">
        <h2>ArtNest</h2>
    </div>

    <ul class="nav-menu">

    <li><a href="#">Home</a></li>

    <li class="dropdown">

        <a href="#">Category ▾</a>

        <ul class="dropdown-menu">

            <li>
                <a href="category.php?category=handmade">
                    Handmade
                </a>
            </li>

            <li>
                <a href="category.php?category=paintings">
                    Paintings
                </a>
            </li>

            <li>
                <a href="category.php?category=ceramics">
                    Ceramics
                </a>
            </li>

            <li>
                <a href="category.php?category=decor">
                    Decor
                </a>
            </li>

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

<?php if($search != '') { ?>

<section class="products">

    <h2>
        Search Results for "<?php echo htmlspecialchars($search); ?>"
    </h2>

    <?php

    $search_safe = mysqli_real_escape_string($conn, $search);

    $product_query = mysqli_query($conn,"
        SELECT * FROM products
        WHERE name LIKE '%$search_safe%'
        OR category LIKE '%$search_safe%'
        OR description LIKE '%$search_safe%'
    ");

    ?>

    <div class="product-grid">

        <?php if(mysqli_num_rows($product_query) > 0){ ?>

            <?php while($p = mysqli_fetch_assoc($product_query)){ ?>

                <div class="product-card">

                    <a href="product.php?id=<?php echo $p['id']; ?>">

                        <img src="images/<?php echo $p['image']; ?>">

                        <h4><?php echo $p['name']; ?></h4>

                        <p>Rs. <?php echo $p['price']; ?></p>

                    </a>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p>No products found.</p>

        <?php } ?>

    </div>

</section>

<?php } else { ?>

<!-- HERO -->

<section class="hero">

    <div class="hero-overlay">

        <h1>Discover Handmade Beauty</h1>

        <p>
            Unique Craftsmanship, Beautiful Art, Elegant Decor
        </p>

        <div class="search-box">

            <form method="GET" action="index.php">

                <input
                    type="text"
                    name="search"
                    placeholder="Search products..."
                >

                <button type="submit">
                    Search
                </button>

            </form>

        </div>

    </div>

</section>

<!-- CATEGORY -->

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

<?php } ?>

<!-- FOOTER -->
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