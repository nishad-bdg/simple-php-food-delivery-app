<header class="htc__header bg--white">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-4 col-md-6 order-1 order-lg-1">
                    <div class="logo">
                        <a href="index.php">
                            <img src="images/logo/foody.png" alt="logo images">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
                    <div class="main__menu__wrap">
                        <nav class="main__menu__nav d-none d-lg-block">
                            <ul class="mainmenu">
                                <li class="drop"><a href="index.php">Home</a></li>
                                <li><a href="about-us.php">About</a></li>
                                <li class="drop"><a href="menu-list.php">Menu</a>
                                    <ul class="dropdown__menu">
                                        <li><a href="menu-list.php">Menu List</a></li>
                                    </ul>
                                </li>

                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>
                <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
                    <div class="header__right d-flex justify-content-end">
                        <?php
                        if (isset($_SESSION['id'])) {
                            if ($_SESSION['user_type'] == 0) {
                                echo '<div class="log__in">
                                <a href="logout.php">logout</a>
                                </div>';
                            }
                        } else {

                            echo '<div class="log__in">
                                    <a class="" href="login.php"><i class="zmdi zmdi-account-o"></i></a>
                                </div>';
                        }

                        ?>
                        <?php
                        if (isset($_SESSION['id'])) {
                            echo ' <div class="shopping__cart">
                             <a class="" href="my-active-orders.php"><i class="zmdi zmdi-assignment"></i></a>
                        </div>';
                        } ?>

                        <div class="shopping__cart">
                            <a class="" href="cart.php"><i class="zmdi zmdi-shopping-basket"></i></a>
                            <div class="shop__qun">
                                <span>
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        echo count($_SESSION['cart']);
                                    } else {
                                        echo 0;
                                    }
                                    ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div class="mobile-menu d-block d-lg-none"></div>
            <!-- Mobile Menu -->
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
<!-- End Header Area -->