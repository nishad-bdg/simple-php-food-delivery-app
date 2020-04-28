<?php
include "init.php";
if (isset($_POST['signin'])) {
    $data = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'username_error' => '',
        'password_error' => ''
    ];

    if (empty($data['username_error']) && empty($data['password_error'])) {
        $user_type = 0;
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
    
}

?>

<?php if(isset($_SESSION['id'])):?>
  <?php if($_SESSION['user_type'] == 0) ?>
  <?php header("location:index.php") ?>
<?php endif; ?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Login</title>
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
        <div class="ht__bradcaump__area">
            <div class="ht__bradcaump__wrap d-flex align-items-center justify-content-center">
                <div class="container ">
                    <div class="row">
                        <div class="col-10 col-md-5 col-sm-5 offset-md-4 offset-1">
                            <?php if (isset($_SESSION['success'])) : ?>
                                <div class="text-center alert alert-success">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                            <?php endif; ?>
                            <?php unset($_SESSION['success']); ?>
                        

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
        </div>
        <!-- End Bradcaump area -->

        <!-- Start Footer Area -->
        <?php include 'partials/_footer.php' ?>
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