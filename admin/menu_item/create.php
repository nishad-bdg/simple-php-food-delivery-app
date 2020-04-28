<?php
include '../pages_init/init.php';
$menu_item = new menu_item();
if (isset($_POST['submit'])) {
  $menuItem = $menu_item->createMenuItem($_POST, $_FILES);
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
  <title>Create Menu</title>
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
                  <h4 class="card-title">Create Menu Item</h4>
                  <!-- alert messages -->
                  <?php include '../partials/_messages.php'; ?>
                  <!-- alert messages -->
                  <form class="" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Menu Name</label>
                      <input type="text" name="menu_name" data-validation="required" class="form-control" placeholder="Menu Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Menu Description</label>
                      <textarea name="description" data-validation="required" placeholder="Menu Description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Price</label>
                      <input type="text" data-validation="number required" class="form-control" id="exampleInputPassword1" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Menu Image</label><br>
                      <input type="file" name="food_img" data-validation="mime size required" data-validation-allowing="jpg, png, gif" accept="image/*" data-validation-max-size="2M" />
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Show On Home Page</label>
                      <select name="show_on_home" class="form-control" data-validation="required">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>

                    <div class="form-group justify-content-center">
                      <button type="submit" name="submit" class="btn btn-primary btn-block mr-2">Submit</button>
                    </div>

                  </form>
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
  $.validate({
    modules: 'file',
  });
</script>