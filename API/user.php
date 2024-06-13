<?php
    include_once "conn.php";
    include_once "token.php";
    include_once "base.php";

    function hassPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function newUser($username, $email, $password, $admin = 0) {
        $conn = getConn();

        $result = getOneUser($conn, email:$email);
        if ($result->num_rows > 0) {
            return "User already exists";
        }

        $hasspass = hassPassword($password);
        $sql = "INSERT INTO user (pseudo, email, password, admin) VALUES (?, ?, ?, ?)";
        $db = $conn->prepare($sql);
        $db->bind_param("sssi", $username, $email, $hasspass, $admin);
        $db->execute();
    
        $result = getOneUser($conn, email:$email);
        $id = $result->fetch_assoc()["ID_User"];
        $token = getToken($username, $email, $admin, create_base($id));
        return $token;
    }

    function connUser($username, $password) {
        $conn = getConn();

        $result = getOneUser($conn, $username);
        if ($result == null || $result->num_rows == 0) {
            return "User not found";
        }

        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $token = getToken($username, $user["email"], $user["admin"], get_base_id($user["ID_User"]));
            return $token;
        } else {
            return "Wrong password";
        }
    }

    function getOneUser($conn, $username = null, $email = null) {
        $sql = "SELECT * FROM user WHERE pseudo = ? OR email = ?";
        $db = $conn->prepare($sql);
        $db->bind_param("ss", $username, $email);
        $db->execute();
        return $db->get_result();
    }

    function getAllUser() {
        $conn = getConn();
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }