<?php
include "init-admin.php";
if (isset($_POST['signup'])) {
    $data = [
        'full_name' => $_POST['full_name'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['confirm_password'],
        'name_error' => '',
        'email_error' => '',
        'username_error' => '',
        'password_error' => '',
        'confirm_error' => '',
    ];

    if (empty($data['full_name'])) {
        $data['name_error'] = "name is required";
    }

    if (empty($data['email'])) {
        $data['email_error'] = "email is required";
    } else {
        if ($source->query("SELECT * FROM users WHERE email = ?", [$data['email']])) {
            if ($source->countRows() > 0) {
                $data['email_error'] = "email is already exists";
            }
        }
    }

    if (empty($data['username'])) {
        $data['username'] = "Username is required";
    } else {
        if ($source->query("SELECT * FROM users WHERE username = ?", [$data['username']])) {
            if ($source->countRows() > 0) {
                $data['username_error'] = "username is already exists";
            }
        }
    }

    if (empty($data['password'])) {
        $data['password_error'] = "password is required";
    } else {
        if (strlen($data['password']) < 5) {
            $data['password_error'] = "password is too short";
        }
    }

    if (empty($data['confirm_password'])) {
        $data['confirm_error'] = "confirm password is required";
    }

    if ($data['password'] != $data['confirm_password']) {
        $data['confirm_error'] = "passwords not matching";
    }

    if (
        empty($data['name_error']) && 
        empty($data['email_error']) && 
        empty($data['username_error']) && 
        empty($data['password_error']) && 
        empty($data['confirm_error']))
    {
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        $user_type= 0;
        if ($source->query(
            "INSERT INTO users (full_name,email,username,password,user_type) VALUES (?,?,?,?,?)",
            [$data['full_name'], $data['email'], $data['username'], $password, $user_type]
        )) {
            $_SESSION['account_created'] = "Your account successfully created";  
            header("location:login.php"); 
        }
        else{
            echo "Something wrong";
        }
    }
    else{
        echo "Error....";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RoyalUI Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="images/logo.svg" alt="logo">
                            </div>

                            <div style="text-align: center;">

                            </div>

                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>



                            <form class="pt-3" action="" method="POST">
                                <div class="form-group">
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['name_error'])) {
                                            echo $data['name_error'];
                                        }
                                        ?>
                                    </span>
                                    <input type="text" name="full_name" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['username_error'])) {
                                            echo $data['username_error'];
                                        }
                                        ?>
                                    </span>
                                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['email_error'])) {
                                            echo $data['email_error'];
                                        }
                                        ?>
                                    </span>
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['password_error'])) {
                                            echo $data['password_error'];
                                        }
                                        ?>
                                    </span>
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['confirm_error'])) {
                                            echo $data['confirm_error'];
                                        }
                                        ?>
                                    </span>
                                    <input type="password" name="confirm_password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm Password" required>
                                </div>

                                <div class="mt-3">
                                    <button name="signup" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Sign Up</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login.html" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>