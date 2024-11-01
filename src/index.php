<?php
  define('BASE_PATH', __DIR__);

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      http_response_code(200);
      exit();
  }

  require_once BASE_PATH . '/simpleRouter.php';
  require_once BASE_PATH . '/controllers/productoController.php';
  require_once BASE_PATH . '/middleware/authMiddleware.php';

  $router = new SimpleRouter();
  $productoController = new ProductoController();
  
  $router->post('/productos', function() use ($productoController) {
    $data = json_decode(file_get_contents("php://input"), true);
    return json_encode($productoController->crearProducto($data));
  });

  $router->put('/productos/{id}', function() use ($productoController) {
    $data = json_decode(file_get_contents("php://input"), true);
    return json_encode($productoController->actualizarProducto($data));
  });

  $router->delete('/productos', function() use ($productoController) {
    $id = json_decode(file_get_contents("php://input"), true);
    return json_encode($productoController->borrarProducto($id));
  });

  $router->get('/productos', function() use ($productoController) {
    return json_encode($productoController->obtenerProductos());
  });

  $router->dispatch();
?>
