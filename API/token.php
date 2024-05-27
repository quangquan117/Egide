<?php
    // require_once './lib/src/JWT.php';
    // require_once './lib/src/BeforeValidException.php';
    // require_once './lib/src/ExpiredException.php';
    // require_once './lib/src/SignatureInvalidException.php';    
    // require_once "config.php";
    // use Firebase\JWT\JWT;
    
    // Function getToken($username, $password) {
    //     $_SECRET_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9";
    //     $issuedAt = time();
    //     $expirationTime = $issuedAt + 3600;  // jwt valid for 1 hour from the issued time
    //     $data = array(
    //         'iat' => $issuedAt,                // Issued at: time when the token was generated
    //         'exp' => $expirationTime,          // Expiration time
    //         "username" => $username,
    //         "password" => $password
    //     );
    //     $encode = JWT::encode($data, $_SECRET_KEY, 'HS256');
    //     return $encode;
    // }