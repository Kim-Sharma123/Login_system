<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $date_created = date('Y-m-d'); // Current date

    $sql = "INSERT INTO users (username, email, password, mobile, city, created_at) VALUES ('$name', '$email', '$pass', '$mobile', '$city', '$date_created')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to the index page after successful insertion
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
