require_once __DIR__ . '/../DB/Database.php';

class Order {
    private $conn;
    private $table = "orders";

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($user_id, $product_id, $quantity) {
        $query = "INSERT INTO {$this->table} (user_id, product_id, quantity) 
                  VALUES (:user_id, :product_id, :quantity)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':user_id' => $user_id,
            ':product_id' => $product_id,
            ':quantity' => $quantity
        ]);
    }
}
