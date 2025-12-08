<?php
session_start();
$full_name = isset($_SESSION['user']) ? $_SESSION['user'] : null;


$page = isset($_GET['page']) ? $_GET['page'] : 'home.html';


$allowed_pages = ['home.html','about.html','ministries.html','events.html','merchandise.html','prayer.html'];
if (!in_array($page, $allowed_pages)) {
    die("Page not found.");
}


$content = file_get_contents($page);


if ($full_name) {
    $replace = '<div class="login-buttons">
                    <span style="color:white; font-weight:bold;">' . $full_name . '</span>
                    <a href="logout.php"><button class="login">Logout</button></a>
                </div>';
    
    
    $content = preg_replace('/<div class="login-buttons">.*?<\/div>/s', $replace, $content);
}

echo $content;
?>
