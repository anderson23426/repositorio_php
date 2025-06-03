
require_once '../models/user.php';
require_once '../models/product.php';
require_once '../models/order.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$input = json_decode(file_get_contents("php://input"), true);

if (strpos($path, '/users') !== false) {
    $userModel = new User();

    if ($method === 'GET') {
        echo json_encode($userModel->getAll());
    } elseif ($method === 'POST') {
        if (isset($input['name'], $input['email'])) {
            $userModel->create($input['name'], $input['email']);
            echo json_encode(["message" => "Usuario creado"]);
        } else {
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }
}

elseif (strpos($path, '/products') !== false) {
    $productModel = new Product();

    if ($method === 'GET') {
        echo json_encode($productModel->getAll());
    } elseif ($method === 'POST') {
        if (isset($input['name'], $input['price'])) {
            $productModel->create($input['name'], $input['price']);
            echo json_encode(["message" => "Producto creado"]);
        } else {
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }
}

elseif (strpos($path, '/orders') !== false) {
    $orderModel = new Order();

    if ($method === 'GET') {
        echo json_encode($orderModel->getAll());
    } elseif ($method === 'POST') {
        if (isset($input['user_id'], $input['product_id'], $input['quantity'])) {
            $orderModel->create($input['user_id'], $input['product_id'], $input['quantity']);
            echo json_encode(["message" => "Pedido creado"]);
        } else {
            echo json_encode(["error" => "Datos incompletos"]);
        }
    }
}
