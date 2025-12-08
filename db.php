<?php
$host = "sqlXXX.infinityfree.com"; // from InfinityFree cPanel
$user = "your_db_username";         // from InfinityFree
$pass = "your_db_password";         // from InfinityFree
$dbname = "your_db_name";           // from InfinityFree

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
