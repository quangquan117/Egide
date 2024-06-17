<?php
    include_once "user.php";
    include_once "./repository/data.php";
    include_once "config.php";
    include_once "token.php";
    include_once "base.php";

    $request_uri = $_SERVER["REQUEST_URI"];
    if (strpos($request_uri, "/sign_up") !== false) {

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"])) {
            // echo newUser($data["username"], $data["email"], $data["password"]);
            $newuser = new user();
            echo $newuser->newUser($data);
            http_response_code(200);
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($request_uri, "/sign_in") !== false) {

        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data["username"]) && isset($data["password"])) {
            $user = new user();
            $result = $user->connUser($data);
            if ($result != "Wrong password") {
                echo $result;
                http_response_code(200);
            } else {
                echo $result;
                http_response_code(201);
            }
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($request_uri, "/get_data_from_token") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["token"])) {
            $result = verifyToken($data["token"]);
            if ($result != null) {
                echo json_encode($result);
                http_response_code(200);
            } else {
                echo "Invalid token";
                http_response_code(201);
            }
        } else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($request_uri, "/get_all_data_from_id") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        // echo json_encode(get_data_from_id($data["type_data"], $data["id"]));
        $data_base = new Data_base();
        echo json_encode($data_base->get_data_from_id($data["type_data"], $data["type_data"], $data["id"]));
        http_response_code(200);
    } else if (strpos($request_uri, "/get_all_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        // echo json_encode(get_data($data["type_data"]));
        $data_base = new Data_base();
        echo json_encode($data_base->get_data($data["type_data"]));
        http_response_code(200);
    } else if (strpos($request_uri, "/update_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        // echo update_data($data["type_data"], $data["id"], $data["data"]);
        $data_base = new Data_base();
        echo $data_base->update_data($data["type_data"], $data["id"], $data["data"]);
        http_response_code(200);
    } else if (strpos($request_uri, "/create_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($data["data"] != null) {
            // echo create_data($data["type_data"], $data["data"]);
            $data_base = new Data_base();
            echo $data_base->create_data($data["type_data"], $data["data"]);
            http_response_code(200);
        }
        else {
            echo "Missing parameters";
            http_response_code(400);
        }
    } else if (strpos($request_uri, "/delete_data") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        // echo delete_data($data["type_data"], $data["id"]);
        $data_base = new Data_base();
        echo $data_base->delete_data($data["type_data"], $data["id"]);
    } else if (strpos($request_uri, "/buy_something") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo buy_something($data["type"], $data["id"], $data["token"]);
        html_entity_decode(200);
    } else if (strpos($request_uri, "/get_data_of_base") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(get_data_of_base($data["token"]));
        http_response_code(200);
    } else if (strpos($request_uri, "/get_ressource") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        $data_token = verifyToken($data["token"]);
        $data_base = new Data_base();
        $base = $data_base->get_data_from_id("base", "Base", $data_token->id_base)[0];
        echo json_encode($base["ressource"]);
        http_response_code(200);
    } else if (strpos($request_uri, "/put_ressource") !== false) {
        $data = json_decode(file_get_contents("php://input"), true);
        $data_token = verifyToken($data["token"]);
        update_ressource($data_token->id_base);
    } else {
        echo "Not found";
        http_response_code(404);
    }