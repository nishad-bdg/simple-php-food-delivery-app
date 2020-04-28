<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?> <a href="#" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
  </div>
</footer>

<style>
  .help-block.form-error {
    color: #7b0d1c !important;
  }
</style>

<script type="text/javascript">
  function confirmPost() {
    var agree = confirm("Are you sure you want to delete?");
    if (agree)
      return true;
    else
      return false;
  }
</script>