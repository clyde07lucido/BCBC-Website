<?php
include 'db.php';

$name = $_POST['name'];
$age = $_POST['age'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$ministry = $_POST['ministry'];
$reason = $_POST['reason'];

$sql = "INSERT INTO registrations (name, age, contact, email, ministry, reason)
        VALUES ('$name', '$age', '$contact', '$email', '$ministry', '$reason')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registration submitted!'); window.location='loadpage.php?page=register.html';</script>";
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>
