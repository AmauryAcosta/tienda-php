<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Request-With");

if($_SERVER['REQUEST_METHOD']==='OPTIONS'){
    http_response_code(200);
    exit();
}

require_once 'controllers/productController.php';
require_once 'middleware/authMiddleware.php';
require_once 'routes/routes.php';

$router = new simpleRouter();
$router->dispatch();
?>