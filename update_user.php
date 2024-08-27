<?php
include 'db_connection.php';

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['city'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];

    $sql = "UPDATE users SET username='$name', mobile='$mobile', city='$city' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
