<?php
include 'db.php';

$name = $_POST['name'];
$contact = $_POST['contact'];
$merch = $_POST['merch'];
$size = $_POST['size'];
$qty = $_POST['qty'];
$note = $_POST['note'];

$sql = "INSERT INTO reservations (name, contact, merch, size, qty, note)
        VALUES ('$name', '$contact', '$merch', '$size', '$qty', '$note')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Reservation submitted!'); window.location='loadpage.php?page=reserve.html';</script>";
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>
