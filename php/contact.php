<?php
include 'config.php';

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, message)
            VALUES ('$name', '$email', '$message')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Message sent successfully');</script>";
    } else {
        echo "<script>alert('Error sending message');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - ArtNest</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
.contact-hero{
    background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),
    url('../images/contact.jpg');
    background-size: cover;
    background-position: center;
    color:white;
    text-align:center;
    padding:80px 20px;
}

.contact-container{
    display:flex;
    justify-content:center;
    gap:40px;
    padding:60px 20px;
    flex-wrap:wrap;
}

.contact-info, .contact-form{
    width:350px;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.contact-form input,
.contact-form textarea{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:10px;
}

.contact-form button{
    width:100%;
    padding:12px;
    background:#1ba8e9;
    color:white;
    border:none;
    border-radius:10px;
}

.back-btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:black;
    color:white;
    text-decoration:none;
    border-radius:8px;
}
</style>

<body>

<section class="contact-hero">
    <h1>Contact ArtNest</h1>
    <p>We are here to help you anytime</p>
</section>

<section class="contact-container">

    <div class="contact-info">
        <h2>Get In Touch</h2>
        <p>Email: artnest@gmail.com</p>
        <p>Phone: +977 9812345670</p>
        <p>Location: Nepalgunj, Banke</p>
    </div>

    <div class="contact-form">
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit" name="send">Send Message</button>
        </form>

        <a href="../index.php" class="back-btn">Back to Home</a>
    </div>

</section>

</body>
</html>