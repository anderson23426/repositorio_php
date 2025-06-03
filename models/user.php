<?php

require_once __DIR__ . '/../DB/Database.php';
class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $email) {
        $query = "INSERT INTO {$this->table} (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email
        ]);
    }
}
