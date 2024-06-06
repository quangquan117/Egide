<?php
    include_once "user.php";
    include_once "data.php";
    include_once "config.php";
    include_once "token.php";

    $request_uri = $_SERVER["REQUEST_URI"];
    if (strpos($request_uri, "/sign_up") !== false){

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"])) {
            echo newUser($data["username"], $data["email"], $data["password"]);
            http_response_code(200);
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($request_uri, "/sign_in") !== false) {

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
    } else if (strpos($request_uri, "/get_data_from_token") !== false) {
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
    } else if (strpos($request_uri, "/get_all_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(get_data($data["type_data"]));
        http_response_code(200);
    } else if (strpos($request_uri, "/get_all_data_from_id") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(get_data_from_id($data["type_data"], $data["id"]));
        http_response_code(200);
    } else if (strpos($request_uri, "/update_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo update_data($data["type_data"], $data["id"], $data["data"]);
        http_response_code(200);
    } else if (strpos($request_uri, "/create_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo create_data($data["type_data"], $data["data"]);
        http_response_code(200);
    }
    else {
        echo "Not found";
        http_response_code(404);
    }