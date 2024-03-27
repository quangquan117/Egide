<?php
    include_once "user.php";

    if (strpos($_SERVER["REQUEST_URI"], "/new_user") !== false){
        
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"])) {
            echo newUser($data["username"], $data["email"], $data["password"]);
            http_response_code(200);
        } else {
            echo "Missing parameters";
            http_response_code(404);
        }
    } else if (strpos($_SERVER["REQUEST_URI"], "/conn_user") !== false) {

        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data["username"]) && isset($data["password"])) {
            echo connUser($data["username"], $data["password"]);
            http_response_code(200);
        } else {
            echo "Missing parameters";
            http_response_code(404);
        }
    }