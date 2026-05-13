<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php'; // session already started here

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // check empty fields
    if(empty($email) || empty($password)){
        die("Please fill all fields");
    }

    // prepare query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // verify user
    if($user && password_verify($password, $user['password'])){

        // store session
        $_SESSION['user'] = $user;

        // ROLE BASED REDIRECT
        if($user['role'] == "admin"){
            header("Location: ../admin/dashboard.php");
            exit();
        }
        elseif($user['role'] == "seller"){
            header("Location: ../seller/seller_dashboard.php");
            exit();
        }
        else{
            header("Location: ../index.php");
            exit();
        }

    } else {
        echo "<script>
            alert('Invalid email or password');
            window.location='../login.html';
        </script>";
    }
}
?>