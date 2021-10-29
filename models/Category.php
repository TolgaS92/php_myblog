<?php
    class Category {
        //DB work
        private $conn;
        private $table = 'categories';

        // properties
        public $id;
        public $name;
        public $created_at;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Posts
        public function read() {
            //Create query
            $query = 'SELECT id, name
                FROM ' . $this->table . '
                ORDER BY
                    created_at DESC';
            //Statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();

            return $stmt;
        }

    }