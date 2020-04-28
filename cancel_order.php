<?php 
    include 'init.php';
    if(isset($_GET['order_id'])){
        $id = $_GET['order_id'];
        echo $id;
        $order = new customer_orders();
        $order->cancelCustomerOrder($id);
        header("location:my-active-orders.php");
    }
