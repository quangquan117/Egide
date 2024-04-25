<?php
    require_once '../lib/src/JWT.php';
    require_once '../lib/src/BeforeValidException.php';
    require_once '../lib/src/ExpiredException.php';
    require_once '../lib/src/SignatureInvalidException.php';
    require_once "config.php";
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    
    Function getToken($username, $password) {
        $_SECRET_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9";
        $data = array(
            "username" => $username,
            "password" => $password
        );
        $encode = JWT::encode($data, $_SECRET_KEY, 'HS256');
        return $encode;
    }