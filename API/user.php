<?php
    include_once "./repository/conn.php";
    include_once "token.php";
    include_once "base.php";

class user {
    private $Data_base;
    public function __construct() {
        $this->Data_base = new Data_base();
    }
    function hassPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    function newUser($data) {
        $email = $data["email"];
        $pseudo = $data["username"];
        $password = $this->hassPassword($data["password"]);
        $user = $this->Data_base->find_user($data["email"]);
        if ($user != null) {
            return "User already exists";
        }
        if ($this->Data_base->create_data("user", ["pseudo" => $pseudo, "email" => $email, "password" => $password, "admin" => 0])) {
            $user = $this->Data_base->find_user($data["email"]);
            $id = $user[0]["ID_User"];
            $token = getToken($pseudo, $email, 0, create_base($id));
            return $token;
        }
        return "Create user failed";
    }

    function connUser($data) {
        $user = $this->Data_base->find_user($data["username"]);
        if ($user == null) {
            return "User not found";
        }
        if (password_verify($data["password"], $user[0]["password"])) {
            $token = getToken($data["username"], $user[0]["email"], $user[0]["admin"], get_base_id($user[0]["ID_User"]));
            return $token;
        } else {
            return "Wrong password";
        }
    }

    function delete_user($id) {
        $this->Data_base->delete_data("user", $id);
        return "Delete done";
    }
}