<?php
include 'connect_users.php';
session_start();
if (isset($_SESSION['login'])) { //jika sudah login
} else {
  die("Anda belum login! Silahkan login <a href='login.php'>di sini</a>");
}

$sql = "SELECT * FROM user where email = '$_SESSION[login]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Users</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <?php
      if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
      ?>
          <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="image_user/<?= $row['photo'] ?>" alt="" width="32" height="32" class="rounded-circle me-2">

                <!-- <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a> -->
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item"><?php echo $_SESSION['login'] ?></a>
              <?php
            }
          }
              ?>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="register.php">Register</a>
              <a class="dropdown-item" href="login.php">Login</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
              <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
          </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index-admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <?php if ($_SESSION['role'] == 'Admin') { ?>
          <li class="nav-item">
            <a class="nav-link" href="table_users.php">
              <i class="fas fa-fw fa-user"></i>
              <span>Users</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="table_mhs.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Mahasiswa</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="table_presensi.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Tabel Presensi</span></a>
          </li>
        <?php } ?>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index-admin.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table Example
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <a class="nav-link" href="register.php">
                  <i class="fas fa-fw fa-user"></i>
                  <span>Add Users</span></a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Date Created</th>
                      <th>Date Modified</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Date Created</th>
                      <th>Date Modified</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    require "connect_users.php";

                    $sql = "SELECT * FROM user";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      //output data of each row
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?= $row["email"]; ?></td>
                          <td><?= $row["name"]; ?></td>
                          <td><?= $row["role"]; ?></td>
                          <td><?= $row["date_create"]; ?></td>
                          <td><?= $row["date_modified"]; ?></td>

                          <td><a href='update_users.php?email=<?= $row['email'] ?>'><i class="bi bi-pencil-fill"></i></a> |
                            <a onClick="return confirm ('Are you sure?')" href='delete_users.php?email=<?= $row['email'] ?>'><i class="bi bi-trash-fill"></i></a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    $conn->close();
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <p class="small text-center text-muted my-5">
            <em>More table examples coming soon...</em>
          </p>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

  </html>
<?php
} else {
  echo "0 results";
}
?>