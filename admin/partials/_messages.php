<?php
if (isset($_SESSION['success'])) : ?>
    <div class="text-center alert alert-success">
        <?php echo $_SESSION['success']; ?>
    </div>
<?php endif; ?>
<?php unset($_SESSION['success']); ?>


<?php
if (isset($_SESSION['error'])) : ?>
    <div class="text-center alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
<?php endif; ?>
<?php unset($_SESSION['error']); ?>