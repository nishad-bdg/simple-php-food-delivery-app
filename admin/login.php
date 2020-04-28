<?php
include "init-admin.php";
if (isset($_POST['signin'])) {
    $data = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'username_error' => '',
        'password_error' => ''
    ];

    if (empty($data['username_error']) && empty($data['password_error'])) {
        $user_type = 1;
        if($source->query("SELECT * FROM users WHERE username = ? AND user_type = ?", [$data['username'],$user_type])){
            if ($source->countRows() > 0) {
                $row = $source->singleRow();
                $id = $row->id;
                $email = $row->email;

                $db_password = $row->password;
                if (password_verify($data['password'], $db_password)) {
                    $_SESSION['login_success'] = "Hi ".$email."You are successfully logged in";
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;
                    $_SESSION['fullname'] = $row->full_name;
                    $_SESSION['user_type'] = $row->user_type;
                    header("location:index.php");
                } else {
                    $data['password_error'] = "Wrong password";
                }
            } else {
                $data['username_error'] = "Wrong username";
            }
        }
    }
    else{
        echo "Error";
    }
}

?>

<?php if(isset($_SESSION['id'])):?>
  <?php if($_SESSION['user_type'] == 1) ?>
  <?php header("location:index.php") ?>
<?php endif; ?>
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
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <?php
                            if (isset($_SESSION['account_created'])) : ?>
                                <div class="text-center alert alert-success">
                                    <?php echo $_SESSION['account_created']; ?>
                                </div>
                            <?php endif; ?>
                            <?php unset($_SESSION['account_created']); ?>

                            <?php if(!empty($data['username_error'])): ?>
                                <div class="text-center alert alert-danger">
                                    <?php echo $data['username_error']; ?>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($data['password_error'])): ?>
                                <div class="text-center alert alert-danger">
                                    <?php echo $data['password_error']; ?>
                                </div>
                            <?php endif ?>



                            <form class="pt-3" action="" method="POST">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="signin" type="submit">SIGN IN</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="signup.php" class="text-primary">Signup</a>
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