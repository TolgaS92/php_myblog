<?php
    class Post {
        //DB work
        private $conn;
        private $table = 'posts';

        // properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Posts
        public function read() {
            //Create query
            $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    p.created_at DESC';
            //Satatement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();

            return $stmt;
        }

    // to get single post
    public function read_single() {
        //Create query
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
        FROM ' . $this->table . ' p
        LEFT JOIN
            categories c ON p.category_id = c.id
        WHERE
            p.id = ?
        LIMIT 0,1';

        //Statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        }

        public function create() {
            //Create query
            $query= 'INSERT INTO ' . $this->table . '
                SET title = :title, body = :body, author = :author, category_id = :category_id';

        // Statement prepare
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print
        printf("Error: %s.\n", $stmt->error);
        return false;
        }

        //Update Post
        public function update() {
            //Update query
            $query= 'UPDATE ' . $this->table . '
                SET title = :title, body = :body, author = :author, category_id = :category_id
                WHERE id = :id';

        // Statement prepare
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        //execute query
        if($stmt->execute()) {
            return true;
        }

        //print
        printf("Error: %s.\n", $stmt->error);
        return false;
        }

        // Delete Post
        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //CLean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Data
            $stmt->bindParam(':id', $this->id);

            //Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if smt wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }