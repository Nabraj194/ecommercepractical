<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - ArtNest</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        body{
            margin:0;
            font-family:Arial, sans-serif;
            background:#f7f7f7;
        }

        /* HERO */
        .about-hero{
            height:40vh;
            background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
            url('../images/about-bg.jpg');
            background-size:cover;
            background-position:center;
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            text-align:center;
        }

        .about-hero h1{
            font-size:45px;
        }

        /* CONTAINER */
        .about-container{
            max-width:1100px;
            margin:auto;
            padding:50px 20px;
        }

        .story{
            background:white;
            padding:40px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            margin-top:-50px;
        }

        .story h2{
            color:#1ba8e9;
            margin-bottom:15px;
        }

        .story p{
            line-height:1.7;
            color:#444;
            font-size:17px;
        }

        /* TEAM */
        .team{
            margin-top:50px;
            text-align:center;
        }

        .team h2{
            font-size:32px;
            margin-bottom:30px;
        }

        .team-grid{
            display:flex;
            justify-content:center;
            gap:20px;
            flex-wrap:wrap;
        }

        .team-card{
            background:white;
            width:220px;
            padding:20px;
            border-radius:15px;
            box-shadow:0 8px 20px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .team-card:hover{
            transform:translateY(-8px);
        }

        .team-card img{
            width:100px;
            height:100px;
            border-radius:50%;
            object-fit:cover;
            margin-bottom:10px;
        }

        .team-card h3{
            margin:10px 0 5px;
        }

        .back-btn{
            display:inline-block;
            margin-top:40px;
            padding:12px 25px;
            background:#1ba8e9;
            color:white;
            text-decoration:none;
            border-radius:25px;
        }

        .back-btn:hover{
            background:#ff9f43;
        }
    </style>
</head>

<body>

<!-- HERO SECTION -->
<div class="about-hero">
    <div>
        <h1>About ArtNest</h1>
        <p>Handmade · Creativity · Passion</p>
    </div>
</div>

<!-- STORY SECTION -->
<div class="about-container">

    <div class="story">
        <h2>Our Story</h2>
        <p>
            ArtNest is a handmade marketplace built to connect artisans with buyers who love unique,
            creative, and meaningful products. We believe every handmade item has a story behind it.
        </p>

        <p>
            From baskets to paintings, ceramics to decor — we bring together local craftsmanship
            into one digital platform.
        </p>
    </div>

    <!-- TEAM SECTION -->
    <div class="team">
        <h2>Meet Our Team</h2>

        <div class="team-grid">

            <div class="team-card">
                <img src="../images/user1.jpg">
                <h3>Founder</h3>
                <p>Creative Vision</p>
            </div>

            <div class="team-card">
                <img src="../images/user2.jpg">
                <h3>Designer</h3>
                <p>UI/UX Expert</p>
            </div>

            <div class="team-card">
                <img src="../images/user3.jpg">
                <h3>Developer</h3>
                <p>Front End</p>
            </div>

            <div class="team-card">
                <img src="../images/user3.jpg">
                <h3>Developer</h3>
                <p>Backend & PHP</p>
            </div>

        </div>

        <a href="../index.php" class="back-btn">Back to Home</a>
    </div>

</div>

</body>
</html>