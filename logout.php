<?php
session_start();
session_destroy();
header("Location: loadpage.php?page=home.html");
exit();
?>
