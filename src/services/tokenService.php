<?php
    class TokenService {
        private $secretKey = 'HI';
        private $expirationTime = 7200;

        public function generarToken($data){
            $payload = [
                'data'=>$data,
                'exp'=>time() + $this->$expirationTime
            ];
            return JWT::encode($payload, $this->secretKey);
        }

        public function verificarToken($token){
            try{
                $decoded=JWT::decode($token, $this->secretKey, ['HS256']);
                return (array) $decoded;
            } cath(Exception $e) {
                return false
            }
        }
    }
?>