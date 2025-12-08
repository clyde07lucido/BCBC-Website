<?php
include 'db.php';

$fullname = $_POST['fullname'];
$age = $_POST['age'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// check if email already exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Email already used!'); window.location='signup.html';</script>";
    exit();
}

// insert into database
$sql = "INSERT INTO users (fullname, age, email, password)
VALUES ('$fullname', '$age', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Signup successful! You can now login.'); window.location='login.html';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
