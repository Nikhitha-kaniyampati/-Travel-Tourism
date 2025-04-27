<?php
session_start();
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Login successful!";
            header("Location: Home.html"); 
            exit();
        } else {
            echo "Error: Invalid password!";
        }
    } else {
        echo "Error: Username not found!";
    }
}
?>

