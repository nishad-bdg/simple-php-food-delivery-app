<?php include 'init.php' ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $menuItem =  new menu_item();
    $menu = $menuItem->getSingleItem($id);
}
?>

<!-- Add to cart -->
<?php
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['id'])) {
        header("location:login.php");
    } else {
        //add to cart
        $products = [
            'food_img' => $_POST['food_img'],
            'menu_name' => $_POST['menu_name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
            'total' => intval($_POST['price']) * intval($_POST['quantity']),
            'id' => $_POST['id']
        ];

        if(isset($_SESSION['cart'])){
            array_push($_SESSION['cart'], $products);
        }else{
            $_SESSION['cart'] = array($products);
        }

        echo "<script>alert('Added to cart');</script>";
    }
}

?>
<!-- add to cart -->

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Menu Details</title>
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
        <div class="ht__bradcaump__area bg-image--18">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Menu Details</h2>
                                <nav class="bradcaump-inner">
                                    <a class="breadcrumb-item" href="index.html">Home</a>
                                    <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                    <span class="breadcrumb-item active">Menu Details</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Blog List View Area -->
        <section class="blog__list__view section-padding--lg menudetails-right-sidebar bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="food__menu__container">
                            <div class="food__menu__inner d-flex flex-wrap flex-md-nowrap flex-lg-nowrap">
                                <div class="food__menu__thumb">
                                    <img width="300" src="images/menu_images/<?php echo $menu->food_img; ?>" alt="images">
                                </div>
                                <div class="food__menu__details">
                                    <div class="food__menu__content">
                                        <h2><?php echo $menu->menu_name; ?></h2>
                                        <ul class="food__dtl__prize d-flex">
                                            <li>$<?php echo $menu->price; ?></li>
                                        </ul>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <p><?php echo $menu->description; ?></p>
                                        <div class="product-action-wrap">
                                            <div class="product-quantity">
                                                <form id='myform' method='POST' action=''>
                                                    <div class="product-quantity">
                                                        <div class="cart-plus-minus">
                                                            <input type="hidden" value="<?php echo $menu->id; ?>" name="id">
                                                            <input type="hidden" value="<?php echo $menu->menu_name; ?>" name="menu_name">
                                                            <input type="hidden" value="<?php echo $menu->price; ?>" name="price">
                                                            <input type="hidden" value="images/menu_images/<?php echo $menu->food_img; ?>" name="food_img">
                                                            <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                                            <div class="add__to__cart__btn ml-5">
                                                                <button type="submit" name="add_to_cart" class="food__btn">Add To Cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Product Descrive Area -->

                        </div>


                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 md--mt--40 sm--mt--40">
                        <div class="food__sidebar">
                            <!-- Start Search Area -->
                            <div class="food__search">
                                <h4 class="side__title">Search</h4>
                                <div class="serch__box">
                                    <input type="text" placeholder="Search keyword">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <!-- End Search Area -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog List View Area -->
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

</style>