<?php  
    include '../pages_init/init.php';
    if(isset($_GET['id'])){
        $data = [
            'id' => $_GET['id'],
        ];

        $delete = new menu_item();
        $delete -> deleteItem($data['id']);
        header("location:index.php");
    }

?>

<?php if(!isset($_SESSION['id'])):?>
  <?php header("location:../login.php ") ?>
<?php endif;?>