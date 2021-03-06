<?php
class Post
{
    private $conn;
    private $table = 'posts';
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $auhor;
    public $created_at;

    // constructor wit db
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //Get posts
    public function read()
    {
        // create query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at 
        FROM
        ' . $this->table . ' p
        LEFT JOIN
            categories c ON p.category_id = c.id
        ORDER BY
            p.created_at DESC';

        // prepare statemet
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Post
    public function read_single()
    {
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM ' . $this->table . ' p LEFT JOIN  categories c ON p.category_id = c.id
            WHERE p.id = ? LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }
}
