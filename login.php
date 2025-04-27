<?php
session_start();
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $username = mysqli_real_escape_string($conn, $username);

    // Fetch user details from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Login successful!";
            header("Location: Home.html"); // Redirect to home page
            exit();
        } else {
            echo "Error: Invalid password!";
        }
    } else {
        echo "Error: Username not found!";
    }
}
?>

