<?php 
    class delete_item extends db{
        public function delete($data){
            $tableName = $data['tableName'];
            $id = $data['id'];
            print_r($data);

            $sql = "DELETE FROM $tableName WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->bindValue(':id',$id);
            $result = $query->execute();
            if($result){
                $_SESSION['success'] = "Item deleted successfully";

            }
            else{
                $_SESSION['error'] = "Can not delete";
            }
        }
    }
?>

