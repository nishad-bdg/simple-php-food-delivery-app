<?php
class customer_orders extends db
{
    public function getAllActiveOrders()
    {
        $sql = "SELECT * FROM customer_orders WHERE status = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAllActiveOrdersForCustomer()
    {
        $userId = $_SESSION['id'];
        $sql = "SELECT * FROM customer_orders WHERE status = 1 AND user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->bindValue(":user_id", $userId);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }



    public function getOrderedItems($orderId)
    {
        $sql = "SELECT * FROM `ordered_items` JOIN `food_items` 
            ON food_items.id = ordered_items.menu_name 
            WHERE `order_id`= :order_id  ";
        $query = $this->db->prepare($sql);
        $query->bindValue(':order_id', $orderId);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function customerDetails($userId)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $userId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }


    public function cancelCustomerOrder($id)
    {
        try{
            $status = 0;
            $sql = " UPDATE `customer_orders` SET `status` = :status WHERE id = :id AND user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->bindValue(':status', $status);
            $query->bindValue(':user_id', $_SESSION['id']);
            $result = $query->execute();
            if($result){
                echo"<script>alert('Order canceled successfully.')</script>";
            }
        }catch(Exception $e){
            echo $e;
        }
        

    }
}
