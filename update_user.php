<?php

include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    
    if (!$id || !$name || !$email || !$phone || !$city) {
        echo 'All fields are required';
        exit();
    }

    $sql = "UPDATE users SET username = '$name', email = '$email', mobile = '$phone', city = '$city' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 'User updated successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn); 
}
