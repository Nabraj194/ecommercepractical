<?php
include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get and clean input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password_raw = $_POST['password'];
    $role = $_POST['role'];

    // Basic validation
    if(empty($name) || empty($email) || empty($password_raw) || empty($role)){
        die("All fields are required");
    }

    // Hash password
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // CHECK DUPLICATE EMAIL
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo "<script>
            alert('Email already exists');
            window.location='../register.html';
        </script>";
        exit();
    }

    // INSERT USER
    $stmt = $conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if($stmt->execute()){
        echo "<script>
            alert('Registration successful');
            window.location='../login.html';
        </script>";
        exit();
    } else {
        echo "Register Failed";
    }
}
?>