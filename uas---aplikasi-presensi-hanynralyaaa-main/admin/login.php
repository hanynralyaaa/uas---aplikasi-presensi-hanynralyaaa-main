<?php

session_start();
// define variables and set to empty values
$emailErr = $passErr = "";
$email = $pass = "";
$valid_email = $valid_password = false;
$dcreated =  date('d/m/Y', time());
$dmodif =  $dcreated;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["pass"])) {
        $passErr = "Password is required";
        $valid_password = false;
    }

    require 'connect_users.php';
    $pass = ($_POST['pass']);
    $email = ($_POST['email']);
    $sql = "SELECT * FROM user where email = '$email' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['role'] == "Dosen") {
            $_SESSION['login'] = $row['email'];
            $_SESSION['role'] = 'Dosen';
            header('location: index.php');
        }

        if ($row['role'] == "Admin") {
            $_SESSION['login'] = $row['email'];
            $_SESSION['role'] = 'Admin';
            header('location: index-admin.php');
        }
        $passErr = "Password atau email salah";
    }
    $conn->close();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

    <title>SB Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                            <label for="inputEmail">Email address</label><span class="error"> *
                                <?php if (isset($emailErr)) { ?>
                                    <p><?php echo $emailErr ?></p>
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="required">
                            <label for="inputPassword">Password</label><span class="error"> *
                                <?php if (isset($passErr)) { ?>
                                    <p><?php echo $passErr ?></p>
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me">
                                Remember Password
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="register.php">Register an Account</a>
                    <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
                </div>
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