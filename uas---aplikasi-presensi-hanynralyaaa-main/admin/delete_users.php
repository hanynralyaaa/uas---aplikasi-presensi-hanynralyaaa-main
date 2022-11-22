<?php
require 'connect_users.php';

$email = $_GET['email'];
$sql = "DELETE FROM user WHERE email = '$email'";

if ($conn->query($sql) == TRUE) {
    // echo "Record deleted successfully";
    header('Location: table_users.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
