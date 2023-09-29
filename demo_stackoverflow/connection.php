<?php 

class  Connection{
    private $host = "localhost";
    private $db = "demo_stackoverflow";
    private $username = "root";
    private $password = "";

    function connect(){

        try {
            $connection = new PDO("mysql:host = $this->host; dbname=$this->db", $this->username, $this->password);
            return $connection;

            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

?>