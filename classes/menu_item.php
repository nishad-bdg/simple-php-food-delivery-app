<?php
class menu_item extends db
{
    private $imagePath = "../../images/menu_images/";

    public function createMenuItem($data, $file)
    {
        $menu_name = ucfirst($data['menu_name']);
        $description =  $data['description'];
        $price =  $data['price'];
        $user_id = $_SESSION['id'];
        $timestamp = date("Y-m-d H:i:s");
        $show_on_home = $data['show_on_home'];

        // handling file data
        $filename = $file['food_img']['name'];
        $filetmp = $file['food_img']['tmp_name'];
        $splitImg = explode('.', $filename);
        $newImgName = strval(rand()) . "." . $splitImg[1];


        $sql = "INSERT INTO food_items (menu_name,description,price,food_img,user_id,show_on_home,timestamp)
                VALUES (:menu_name,:description,:price,:food_img,:user_id,:show_on_home,:timestamp)";
        $query = $this->db->prepare($sql);
        $query->bindValue(':menu_name', $menu_name);
        $query->bindValue(':description', $description);
        $query->bindValue(':price', $price);
        $query->bindValue(':food_img', $newImgName);
        $query->bindValue(':show_on_home', $show_on_home);
        $query->bindValue(':user_id', $user_id);
        $query->bindValue(':timestamp', $timestamp);
        $result = $query->execute();
        if ($result) {
            move_uploaded_file($filetmp, $this->imagePath . "" . $newImgName);
            // echo getcwd();
            $msg = "Item added successfully";
            $_SESSION['success'] = $msg;
        }
    } //function create ends here


    public function getAllMenus()
    {
        $sql = "SELECT * FROM food_items";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }


    public function menuForHome(){
        $sql = "SELECT * FROM food_items WHERE show_on_home = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }


    public function getSingleItem($id)
    {
        $sql_select = "SELECT * FROM food_items WHERE id= :id ";
        $query_select = $this->db->prepare($sql_select);
        $query_select->bindValue(':id', $id);
        $query_select->execute();
        $result_select = $query_select->fetch(PDO::FETCH_OBJ);
        return $result_select;
    }

    public function updateItem($id, $data, $file)
    {
        $menu_name = ucfirst($data['menu_name']);
        $description =  $data['description'];
        $price =  $data['price'];
        $show_on_home = $data['show_on_home'];
        $timestamp = date("Y-m-d H:i:s");

        //file
        $filename = $file['food_img']['name'];
        $filetmp = $file['food_img']['tmp_name'];


        if (empty($filename)) {
            $sql = "UPDATE food_items SET menu_name = :menu_name, description= :description,
            price = :price, show_on_home= :show_on_home, timestamp = :timestamp WHERE id = :id";

            $query = $this->db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->bindValue(':menu_name', $menu_name);
            $query->bindValue(':description', $description);
            $query->bindValue(':price', $price);
            $query->bindValue(':show_on_home', $show_on_home);
            $query->bindValue(':timestamp', $timestamp);
        } else {
            $sql_select = "SELECT * FROM food_items WHERE id= :id ";
            $query_select = $this->db->prepare($sql_select);
            $query_select->bindValue(':id', $id);
            $query_select->execute();
            $result_select = $query_select->fetch(PDO::FETCH_OBJ);
            unlink($this->imagePath . "" . $result_select->food_img);

            $splitImg = explode('.', $filename);
            $newImgName = strval(rand()) . "." . $splitImg[1];


            $sql = "UPDATE food_items SET menu_name = :menu_name, description= :description,
                price = :price, show_on_home= :show_on_home, food_img = :food_img ,timestamp = :timestamp WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->bindValue(':menu_name', $menu_name);
            $query->bindValue(':description', $description);
            $query->bindValue(':price', $price);
            $query->bindValue(':show_on_home', $show_on_home);
            $query->bindValue(':food_img', $newImgName);
            $query->bindValue(':timestamp', $timestamp);
            move_uploaded_file($filetmp, $this->imagePath . "" . $newImgName);
        }

        $result = $query->execute();

        if ($result) {
            $msg = "<div class='alert alert-success text-center'>Item updated successfully</div>";
            return $msg;
        } else {
            echo "Error saving data";
        }
    }

    public function deleteItem($id)
    {
        $sql_select = "SELECT * FROM food_items WHERE id= :id ";
        $query_select = $this->db->prepare($sql_select);
        $query_select->bindValue(':id', $id);
        $query_select->execute();
        $result_select = $query_select->fetch(PDO::FETCH_OBJ);

        $sql = "DELETE FROM food_items WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $result = $query->execute();
        if ($result) {
            unlink($this->imagePath . "" . $result_select->food_img);
            $_SESSION['success'] = "Item deleted successfully";
        } else {
            $_SESSION['error'] = "Can not delete";
        }
    }
}//class ends here
