<?php 
    class db{
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "food_delivery";
        protected $db;

        public function __construct()
        {
            try{
                //create database connection
                $this->db = new PDO("mysql:host=" .$this->host . ";dbname=" .$this->database,$this->username,$this->password);
            }catch(PDOException $e){
                echo "Connection Problem: ". $e->getMessage();
            }
        }

    }
?>