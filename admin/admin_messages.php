<?php
include '../php/config.php';
session_start();

/* ADMIN CHECK */
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    die("Access Denied");
}

/* FETCH MESSAGES */
$messages = mysqli_query($conn,"SELECT * FROM contact_messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Messages</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="dashboard">

<h1>📩 Contact Messages</h1>

<!-- TOTAL COUNT -->
<div class="cards">
    <div class="card">
        <h2><?php echo mysqli_num_rows($messages); ?></h2>
        <p>Total Messages</p>
    </div>
</div>

<!-- MESSAGES LIST -->
<div class="product-grid">

<?php while($m = mysqli_fetch_assoc($messages)){ ?>

    <div class="product-card">

        <h3><?php echo $m['name']; ?></h3>

        <p><b>Email:</b> <?php echo $m['email']; ?></p>

        <p><?php echo $m['message']; ?></p>

        <small>ID: <?php echo $m['id']; ?></small>

        <br><br>

        <!-- DELETE BUTTON -->
        <a href="delete_message.php?id=<?php echo $m['id']; ?>" 
           style="color:red;">
           Delete
        </a>

    </div>

<?php } ?>

</div>

</div>

</body>
</html>