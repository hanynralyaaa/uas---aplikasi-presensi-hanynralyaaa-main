<?php
require 'connect_db.php';

$id = $_GET['id'];
$sql = "DELETE FROM presensi WHERE id = '$id'";

if ($conn->query($sql) == TRUE) {
    // echo "Record deleted successfully";
    header('Location: table_presensi.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
