<?php
// $host = "sql306.infinityfree.com";                     // local MySQL server
// $user = "if0_40624970";                          // default XAMPP username
// $pass = "BCBC4JESUS0777";                              // default XAMPP password (empty)
// $dbname = "if0_40624970_bcbc_db";       // your local database name

// $conn = mysqli_connect($host, $user, $pass, $dbname);

// if (!$conn) {
//     die("Database connection failed: " . mysqli_connect_error());
// }
?>

<?php
$host = "localhost";   // local MySQL server
$user = "root";        // MySQL username
$pass = "";            // MySQL password (empty in XAMPP)
$dbname = "bcbc_db";   // database you created in phpMyAdmin

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

