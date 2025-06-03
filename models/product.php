require_once __DIR__ . '/../DB/Database.php';

class Product {
    private $conn;
    private $table = "products";

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $price) {
        $query = "INSERT INTO {$this->table} (name, price) VALUES (:name, :price)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $name,
            ':price' => $price
        ]);
    }
}
