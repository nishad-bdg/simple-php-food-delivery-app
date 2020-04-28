<?php 
    include 'init.php';
    
    if(isset($_GET['main_pos'])){
        $main_pos = intval($_GET['main_pos']);

        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart'][$main_pos]);
            header("location:cart.php");
        }
    }
?>