<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO contacts (firstname, lastname, email, subject) VALUES ('$fname', '$lname', '$email', '$subject')";

    if (mysqli_query($conn, $sql)) {
        echo "Thank you for contacting us!";
        header("Location: feedback.html"); // Redirect back to contact page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
