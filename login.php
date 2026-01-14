<?php
// session_start();
// include 'db.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

//     if (mysqli_num_rows($result) === 1) {
//         $row = mysqli_fetch_assoc($result);

//         if (password_verify($password, $row['password'])) {
//             $_SESSION['user'] = $row['fullname'];

//             echo "<script>
//                     localStorage.setItem('fullname', '". $row['fullname'] ."');
//                     window.location='loadpage.php?page=index.html';
//                 </script>";
//             exit();
//         }
//     }

//     echo "<script>alert('Invalid login details!'); window.location='login.html';</script>";
// } else {
//     // If someone accesses login.php directly without POST
//     echo "405 Method Not Allowed";
//     http_response_code(405);
// }
?>


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
        header("Location: loadpage.php?page=index.html"); 
        exit(); 
    } 
} 

echo "<script>alert('Invalid login details!'); 
window.location='login.html';</script>"; 
?>
