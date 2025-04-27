<?php
// Connect to Database
/*$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$database = "your_db_name";*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourism"; // Your database name
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    // Insert into database
    $sql = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful! <a href='pplogin.html'>Login Now</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
