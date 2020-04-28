<?php
include '../pages_init/init.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $orders =  new customer_orders();
    $customer = $orders->customerDetails($id);
}


?>

<?php if (!isset($_SESSION['id'])) : ?>
    <?php header("location:../login.php ") ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer Details</title>
    <!-- plugins:css -->
    <?php include '../partials/_header-js.php' ?>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../partials/_navbar.html -->
        <?php include '../partials/_navbar.php' ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../partials/_sidebar.html -->
            <?php include '../partials/_sidebar.php' ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Customer Details</h4>
                                    <!-- alert messages -->
                                    <?php include '../partials/_messages.php'; ?>
                                    <!-- alert messages -->
                                    <div class="mb-2">Name: <?php echo $customer->full_name; ?></div>
                                    <div class="">Email: <?php echo $customer->email; ?></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../partials/_footer.html -->
                <?php include '../partials/_footer.php' ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <!-- End custom js for this page-->
</body>

</html>

<script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script>

<style>
    .table-img {
        width: 100px !important;
        height: auto !important;
        border-radius: 10px !important;
    }
</style>