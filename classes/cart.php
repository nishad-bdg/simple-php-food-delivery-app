<?php
class cart extends db
{
    private $lastId;
    public function createOrder()
    {
        $timestamp = date("Y-m-d H:i:s");
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $value) {
            foreach ($value as $subKey => $item) {
                if ($subKey == "total") {
                    $totalPrice += $item;
                }
            }
        }
        //create order
        $sql = "INSERT INTO customer_orders (user_id,total,timestamp) VALUES
                (:user_id,:total,:timestamp)";
        $query = $this->db->prepare($sql);
        $query->bindValue(":user_id", $_SESSION['id']);
        $query->bindValue(":total", $totalPrice);
        $query->bindValue(":timestamp", $timestamp);
        $result = $query->execute();
        if ($result) {
            $this->lastId = $this->db->lastInsertId();
            
            echo "<script>alert('Order Placed Thank You')</script>";
            return $this->lastId;
        }
    }


    public function checkout()
    {
        self::createOrder();
        foreach ($_SESSION['cart'] as $value) {
            foreach ($value as $subKey => $item) {
                if ($subKey == "id") {
                    $menu_name = $item;
                } elseif ($subKey == "price") {
                    $price = $item;
                } elseif ($subKey == "quantity") {
                    $quantity = $item;
                } elseif ($subKey == "total") {
                    $total_price = $item;
                }
            } // inner for loop

            $sql = "INSERT INTO ordered_items (order_id,menu_name,quantity,price,total_price)
                VALUES(:order_id,:menu_name,:quantity,:price,:total_price)";
            $query = $this->db->prepare($sql);
            $query->bindValue(":order_id", $this->lastId);
            $query->bindValue(":menu_name", $menu_name);
            $query->bindValue(":quantity", $quantity);
            $query->bindValue(":price", $price);
            $query->bindValue(":total_price", $total_price);
            $query->execute();

        } //main for loop
        unset($_SESSION['cart']);
    }
}
