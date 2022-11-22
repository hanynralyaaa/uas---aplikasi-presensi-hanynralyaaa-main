<?php
require "connect_users.php";

$pw = sha1($_POST['pass']);
$emaill = $_POST['email'];
$sql2 = "UPDATE user SET name='$name', password='$pw', role='$role', photo='$photo', date_modified = '$dmodified'
        WHERE email='$emaill'";

if ($conn->query($sql2) == TRUE) {
    echo "<br>";
    // echo "New Record created successfully";
    header('Location: table_users.php');
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$conn->close();
