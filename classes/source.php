<?php 
    class source extends db{
        public $query;
        //Query method accept all database queries
        public function query($query_param,$param = []){
            if(empty($param)){
                //if we do not have the param
                $this->query = $this->db->prepare($query_param);
                return $this->query->execute();
            }else{
                //if we have param
                $this->query = $this->db->prepare($query_param);
                return $this->query->execute($param);
            }
        }

        //count the number of rows
        public function countRows(){
            return $this->query->rowCount();
        }

        //fecth all records
        public function fetchAllData(){
            return $this->query->fetchAll(PDO::FETCH_OBJ);
        }

        //fetch single row
        public function singleRow(){
            return $this->query->fetch(PDO::FETCH_OBJ);
        }
    }
?>