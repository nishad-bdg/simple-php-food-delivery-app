<?php
include '../pages_init/init.php';
$customerOrders = new customer_orders();
$items = $customerOrders->getAllActiveOrders();
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
    <title>Customer Orders</title>
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
                                    <h4 class="card-title">Customer Orders</h4>
                                    <!-- alert messages -->
                                    <?php include '../partials/_messages.php'; ?>
                                    <!-- alert messages -->
                                    <!-- Data Table -->

                                    <table class="table" id="tableData">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer Id</th>
                                                <th>Total</th>
                                                <th>Created</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($items as $item) {
                                                echo "
                                                <tr>
                                                    <td>" . $item->id . "</td>
                                                    <td><a href= customer-details.php?id=".$item->user_id.">" . $item->user_id . "</a></td>
                                                    <td>".$item->total."</td>
                                                    <td>".$item->timestamp."</td>";

                                                    echo "<td>";
                                                    if($item->status == 1){
                                                        echo "active";
                                                    }else{
                                                        echo "canceled";
                                                    }
                                                    
                                                    echo"</td>";

                                                    echo"
                                                    <td>
                                                    <a href='view-items.php?id=" . $item->id . "'  class='btn'><i class='fa fa-eye'></i></a>
                                                    <a onClick='return confirmPost();' href='delete.php?id=" . $item->id . "' class='btn'><i class='fa fa-trash'></i></a>
                                                    
                                                    </td>
                                                </tr>
                                                ";
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                    <!-- Data Table -->

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