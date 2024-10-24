<?php
require_once '../controllers/productoController.php';
require_once '../middleware/authMiddleware.php';

$productoController = new ProductoController();

$app->post('/productos', function () use ($productoController) {
    $data = json_decode(file_get_contents("php//input"), true);
    return json_encode($productoController->crearProducto($data));
});

$app->put('/productos', function () use ($productoController) {
    $data = json_decode(file_get_contents("php//input"), true);
    return json_encode($productoController->actualizarProducto($data));
});

$app->delete('/productos/{id}', function($id) use ($productoController){
    return json_decode($productoController->borrarProducto($id));
});

$app->get('/productos', function() use ($productoController){
    return json_decode($productoController->obtenerProductos());
});

?>