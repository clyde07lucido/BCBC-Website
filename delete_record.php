<?php
include 'db.php';

$table = $_GET['table'];
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM $table WHERE id=$id");
header("Location: admin_dashboard.php");
exit();