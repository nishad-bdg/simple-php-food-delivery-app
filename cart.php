<?php include 'init.php'; ?>
<?php
if (isset($_POST['checkout'])) {
    $checkout = new cart();
    $checkout->checkout();
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart || Aahar Food Delivery Html5 Template</title>
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
        <?php include "partials/_nav_menu.php"; ?>
        <!-- End Header Area -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--18">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">cart page</h2>
                                <nav class="bradcaump-inner">
                                    <a class="breadcrumb-item" href="index.html">Home</a>
                                    <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                    <span class="breadcrumb-item active">cart page</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (isset($_SESSION['cart'])) {
                                            $totalPrice = 0;
                                            foreach ($_SESSION['cart'] as $mainKey => $val) {
                                                echo '
                                            <tr>';

                                                foreach ($val as $key => $item) {
                                                    if ($key == "food_img") {
                                                        echo '<td class="product-thumbnail"><a href="#"><img src="' . $item . '" alt="product img" /></a></td>';
                                                    }

                                                    if ($key == "menu_name") {
                                                        echo '<td class="product-name"><a href="#">' . $item . '</a></td>';
                                                    }

                                                    if ($key == "price") {
                                                        echo '<td class="product-price"><span class="amount">$' . $item . '</span></td>';
                                                    }
                                                    if ($key == "quantity") {
                                                        echo '<td class="product-quantity"><input type="number" value="' . $item . '" /></td>';
                                                    }

                                                    if ($key == "total") {
                                                        $totalPrice += $item;
                                                        echo '<td class="product-subtotal">' . $item . '</td>';
                                                    }

                                                    if ($key == "id") {
                                                        echo '
                                                        <td class="product-remove"><a onClick="return confirmPostDelete();" href="remove_cart.php?main_pos=' . $mainKey . '"> X</a></td>';
                                                    }
                                                }

                                                echo '
                                            </tr>
                                            ';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list" style="text-align:right">
                                <?php if (isset($_SESSION['cart'])) : ?>
                                    <form action="" method="POST">
                                        <li><button class="btn btn-success" name="checkout" type="submit">Check Out</button></li>
                                    </form>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">

                            <div class="cart__total__amount">

                                <span>Grand Total</span>
                                <span>$<?php echo $totalPrice; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        <!-- Start Footer Area -->
        <?php include 'partials/_footer.php' ?>
        <!-- End Footer Area -->


    </div><!-- //Main wrapper -->

    <!-- JS Files -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
</body>

</html>