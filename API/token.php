<?php
    require_once '../vendor/autoload.php';
    include_once "config.php";
    use Firebase\JWT\JWT;
    
    Function getToken($username, $email, $admin) {
        $_SECRET_KEY = SECRET_KEY;
        $data = array(
            // 'iat' => time(),
            // 'exp' => strtotime("+8 hour"),
            "username" => $username,
            "email" => $email,
            "admin" => ($admin == 1 ? true : false)
        );
        $encode = JWT::encode($data, $_SECRET_KEY, 'HS256');
        return $encode;
    }

    Function verifyToken($token) {
        $_SECRET_KEY = SECRET_KEY;
        try {
            $decode = JWT::decode($token, new Firebase\JWT\Key($_SECRET_KEY, 'HS256'));
            return $decode;
        } catch (Exception $e) {
            return null;
        }
    }