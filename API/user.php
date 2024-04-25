<?php
    include_once "conn.php";
    include_once "token.php";

    function hassPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function newUser($username, $email, $password, $admin = 0) {
        $conn = getConn();

        $result = getUser($conn, $username);
        if ($result->num_rows > 0) {
            return "User already exists";
        }

        $hasspass = hassPassword($password);
        $sql = "INSERT INTO user (pseudo, email, password, admin) VALUES (?, ?, ?, ?)";
        $db = $conn->prepare($sql);
        $db->bind_param("sssi", $username, $email, $hasspass, $admin);
        $db->execute();
        $token = getToken($username, $password);
        return $token;
    }

    function connUser($username, $password) {
        $conn = getConn();

        $result = getUser($conn, $username);
        if ($result == null || $result->num_rows == 0) {
            return "User not found";
        }

        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $token = getToken($username, $password);
            return $token;
        } else {
            return " Wrong password";
        }
    }

    function getUser($conn, $username, $email = null) {
        $sql = "SELECT * FROM user WHERE pseudo = ? OR email = ?";
        $db = $conn->prepare($sql);
        $db->bind_param("ss", $username, $email);
        $db->execute();
        return $db->get_result();
    }