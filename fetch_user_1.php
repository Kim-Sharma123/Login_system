<?php
include 'db_connection.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr data-id='" . $row['id'] . "'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['mobile'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>";
        echo "<button onclick='editUser(" . $row['id'] . ")' class='btn btn-primary btn-sm'>Edit</button> ";
        echo "<button onclick='deleteUser(" . $row['id'] . ")' class='btn btn-danger btn-sm'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No users found</td></tr>";
}

$conn->close();
?>
