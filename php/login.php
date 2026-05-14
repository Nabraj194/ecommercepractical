<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        die("Please fill all fields");
    }

    // secure query
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        // secure session storage (not full user object)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // role redirect
        if ($user['role'] === "admin") {
            header("Location: ../admin/dashboard.php");
        } elseif ($user['role'] === "seller") {
            header("Location: ../seller/seller_dashboard.php");
        } else {
            header("Location: ../index.php");
        }
        exit();

    } else {
        echo "<script>
            alert('Invalid email or password');
            window.location='../login.html';
        </script>";
    }
}
?>