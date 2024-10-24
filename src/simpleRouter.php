<?php
    class simpeRouter {
        private $routes = [];

        public function get($path, $callback){
            $this->routes['GET'][$path] = $callback;
        }
        public function dispatch(){
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH');
            foreach($this->routes['$requestMethod'] as $path=> $callback){
                if($requestUri === $path){
                    echo json_encode($callback());
                    return;
                }
            }
            http_response_code(404);
            echo json_encode(['message'=>'not found']);
        }
    }
?>