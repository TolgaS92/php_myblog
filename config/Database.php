<?php
    class Database {
        // DB parameters
        private $db_config = array();
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'root';
        private $password = 'root';
        private $conn;

        //DB connection
        public function connect() {
            $this->conn = null;

            try {
                //code...
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //throw $th;
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>