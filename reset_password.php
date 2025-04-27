<?php

include 'dbconnect.php';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $new_pass = trim($_POST['new_password']);
    $confirm_pass = trim($_POST['confirm_password']);

    if ($new_pass !== $confirm_pass) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $hashed_password, $user);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Password updated successfully!'); window.location.href='pplogin.html';</script>";
        } else {
            echo "<script>alert('User not found or password not changed.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "Something went wrong. Please try again later.";
    }
}

$conn->close();
?>
