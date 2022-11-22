<?php
require "connect_users.php";

$sql = "INSERT INTO user (email, name, password, role, photo, date_create, date_modified) 
VALUES ('$email', '$name', '$pass', '$role', '$photo', '$dcreated', '$dmodif')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: table_users.php');
