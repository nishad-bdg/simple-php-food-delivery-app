<?php
include "init.php";
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
        empty($data['confirm_error'])
    ) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user_type = 0;
        if ($source->query(
            "INSERT INTO users (full_name,email,username,password,user_type) VALUES (?,?,?,?,?)",
            [$data['full_name'], $data['email'], $data['username'], $password, $user_type]
        )) {
            $_SESSION['success'] = "Your account successfully created";
            header("location:login.php");
        }
    }
}
?>

<?php if (isset($_SESSION['id'])) : ?>
    <?php if ($_SESSION['user_type'] == 0) ?>
    <?php header("location:index.php") ?>
<?php endif; ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Signup</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/icon.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="style.css">

    <!-- Cusom css -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer js -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

    <!-- Add your site or application content here -->

    <!-- <div class="fakeloader"></div> -->

    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">
        <!-- Start Header Area -->
        <?php include 'partials/_nav_menu.php' ?>
        <!-- End Header Area -->
        <!-- Start Bradcaump area -->
        <div class="">
            <div class=" d-flex align-items-center justify-content-center">
                <div class="container ">
                    <div class="row">
                        <div class="col-10 col-md-5 col-sm-5 offset-md-4 offset-1">
                            <form class="pt-3" action="" method="POST">
                                <div class="form-group">

                                    <input type="text" name="full_name" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Full Name" required>
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['name_error'])) {
                                            echo $data['name_error'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">

                                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" required>
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['username_error'])) {
                                            echo $data['username_error'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">

                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['email_error'])) {
                                            echo $data['email_error'];
                                        }
                                        ?>
                                    </span>
                                </div>

                                <div class="form-group">

                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['password_error'])) {
                                            echo $data['password_error'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">

                                    <input type="password" name="confirm_password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm Password" required>
                                    <span class="form-error">
                                        <?php
                                        if (!empty($data['confirm_error'])) {
                                            echo $data['confirm_error'];
                                        }
                                        ?>
                                    </span>
                                </div>

                                <div class="mt-3">
                                    <button name="signup" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Sign Up</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login.php" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

        <!-- Start Footer Area -->

        <!-- End Footer Area -->
        <!-- Login Form -->


        <!-- Cartbox -->
        <?php include 'partials/_cart.php' ?>
        <!-- //Cartbox -->
    </div><!-- //Main wrapper -->

    <!-- JS Files -->
    <?php include 'partials/_js.php' ?>
</body>

</html>

<style>
    .form-error {
        color: #EC421E;
    }
</style>