<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$pray_to = $_POST['pray_to'];
$prayer = $_POST['prayer'];

$sql = "INSERT INTO prayer_requests (name, email, pray_to, prayer_request) 
        VALUES ('$name', '$email', '$pray_to', '$prayer')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Prayer request submitted!'); window.location='loadpage.php?page=prayer.html';</script>";
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>
