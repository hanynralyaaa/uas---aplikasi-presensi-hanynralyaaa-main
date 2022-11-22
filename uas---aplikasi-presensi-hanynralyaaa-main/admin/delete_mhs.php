<?php
require 'connect_db.php';

$nim = $_GET['nim'];
$sql = "DELETE FROM mahasiswa WHERE nim = '$nim'";

if ($conn->query($sql) == TRUE) {
    // echo "Record deleted successfully";
    header('Location: table_mhs.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
