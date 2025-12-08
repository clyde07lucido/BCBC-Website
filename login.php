<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = $row['fullname'];
        header("Location: loadpage.php?page=home.html");
        exit();
    }
}

echo "<script>alert('Invalid login details!'); window.location='login.html';</script>";
?>
