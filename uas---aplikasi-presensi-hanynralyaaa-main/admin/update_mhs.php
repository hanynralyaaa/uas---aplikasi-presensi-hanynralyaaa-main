<?php
ob_start();
// define variables and set to empty values
$namaErr = $kelasErr = "";
$attrKelasA = $attrKelasB = "";

require "connect_db.php";

$Nim = $_GET['nim'];
$sql1 = "SELECT * FROM mahasiswa WHERE nim = '$Nim'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //view value which is selected
        switch ($row['kelas']) {
            case "5A":
                $attrKelasA = "selected";
                break;
            case "5B":
                $attrKelasB = "selected";
                break;
            default:
                $attrKelasA = $attrKelasB = "";
        }
        $nim2 = $row['nim'];
        $nama2 = $row['nama'];
        $kelas2 = $row['kelas'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Input Data Mahasiswa</div>
            <div class="card-body">
                <form method="post" action="update_insert_mhs.php">
                    <div class="form-group">
                        <div class="form-label-group">
                            <label for="nim">NIM</label><br><br>
                            <input type="text" id="nim" name="nim" class="form-control" value="<?= $nim2 ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label for="nama">Nama</label><br><br>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= $nama2 ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label for="nama">Kelas</label><br><br>
                            <select name="kelas">
                                <option value="">--Select--</option>
                                <option value="5A" <?php echo $attrKelasA ?>>5A</option>
                                <option value="5B" <?php echo $attrKelasB ?>>5B</option>
                            </select>
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-primary btn-block">Input</button>

                    <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>