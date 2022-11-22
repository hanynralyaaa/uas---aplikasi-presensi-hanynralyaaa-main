<?php
ob_start();
// define variables and set to empty values
$nameErr = $emailErr = $passErr = $confpassErr = $roleErr = $photoErr = "";
$email = $name = $pass = $confpass = $role = $photo = "";
$attrAdmin = $attrDosen = "";

require "connect_users.php";

$Email = $_GET['email'];
$sql1 = "SELECT * FROM user WHERE email = '$Email'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //view value which is selected
        switch ($row['role']) {
            case "Admin":
                $attrAdmin = "selected";
                break;
            case "Dosen":
                $attrDosen = "selected";
                break;
            default:
                $attrAdmin = $attrDosen = "";
        }
        $nama = $row['name'];
        $password = $row['password'];
        $email = $row['email'];
        $foto = $row['photo'];
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>SB Admin - Update</title>

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
                <div class="card card-register mx-auto mt-5">
                    <div class="card-header">Edit an Account</div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="<?= $email; ?>">
                                    <label for="inputEmail">Email address</label><span class="error"> *
                                        <?php if (isset($emailErr)) { ?>
                                            <p><?php echo $emailErr ?></p>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" value="<?= $nama; ?>">
                                    <label for="inputName">Name</label><span class="error"> *
                                        <?php if (isset($nameErr)) { ?>
                                            <p><?php echo $nameErr ?></p>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" value="<?= $password; ?>">
                                            <label for="inputPassword">Password</label><span class="error"> *
                                                <?php if (isset($passErr)) { ?>
                                                    <p><?php echo $passErr ?></p>
                                                <?php } ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="file" accept=".jpg, .jpeg, .png" name="photo" onchange="loadFile(event)" value="<?php echo $foto; ?>">
                                    <label for="filebutton">Image</label><span class="error">* <?php echo $photoErr; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <select name="role"><span class="error"> *
                                                <option value="">--Select--</option>
                                                <option value="Admin" <?php echo $attrAdmin ?>>Admin</option>
                                                <option value="Dosen" <?php echo $attrDosen ?>>Dosen</option>
                                        </select>
                                        <span><?php echo $roleErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                            <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->
                        </form>
                    </div>
                </div>
            </div>
    <?php
    } //end of while
} else {
    echo "0 results";
}
    ?>
        </body>

        </html>
        <?php
        function sanitize($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        // define variables and set to empty values
        $nameErr = $emailErr = $passErr = $confpassErr = $roleErr = $photoErr = "";
        $email = $name = $pass = $confpass = $role = $photo = "";
        $valid_email = $valid_name = $valid_password = $valid_role = $valid_photo = false;
        $pass_same = $pass_diff = "";
        $dmodified =  date('d/m/Y', time());

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
                $valid_name = false;
            } else {
                $name = sanitize($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    $nameErr = "Only letters and white space allowed";
                    $valid_name = false;
                } else {
                    $valid_name = true;
                }
            }

            if (empty($_POST["pass"])) {
                $passErr = "Password is required";
                $valid_password = false;
            } else {
                $valid_password = true;
            }

            if (empty($_POST["role"])) {
                $roleErr = "Role is required";
                $valid_role = false;
            } else {
                $role = sanitize($_POST["role"]);
                $valid_role = true;
            }
            if (empty($_POST["photo"])) {
                // $photoErr = "Photo is required";
            } else {
                $photo = sanitize($_POST["photo"]);
                $valid_photo = true;
            }
        }

        if ($valid_name && $valid_password && $valid_role && $valid_photo == true) {
            include 'update_insert_users.php';
        }
        //$conn->close();
        ?>