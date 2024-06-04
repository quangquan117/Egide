<?php
    include_once "user.php";
    include_once "config.php";
    include_once "token.php";

    if (strpos($_SERVER["REQUEST_URI"], "/sign_up") !== false){

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"])) {
            echo newUser($data["username"], $data["email"], $data["password"]);
            http_response_code(200);
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($_SERVER["REQUEST_URI"], "/sign_in") !== false) {

        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data["username"]) && isset($data["password"])) {
            $resulte = connUser($data["username"], $data["password"]);
            if ($resulte != "Wrong password") {
                echo $resulte;
                http_response_code(200);
            } else {
                echo $resulte;
                http_response_code(201);
            }
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($_SERVER["REQUEST_URI"], "/get_data_from_token") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["token"])) {
            $resulte = verifyToken($data["token"]);
            if ($resulte != null) {
                echo json_encode($resulte);
                http_response_code(200);
            } else {
                echo "Invalid token";
                http_response_code(201);
            }
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    }