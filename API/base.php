<?php
    include_once ("token.php");
// CREATE TABLE base (
//     ID_Base INT PRIMARY KEY AUTO_INCREMENT,
//     ID_User_FK INT,
//     resource NUMERIC,
//     FOREIGN KEY (ID_User_FK) REFERENCES user(ID_User)
// );

    function get_QG(){
        $conn = getConn();
        $sql = "SELECT * FROM batiment WHERE nom = 'QG'";
        $db = $conn->prepare($sql);
        $db->execute();
        $result = $db->get_result();
        $QG = $result->fetch_assoc();
        return $QG["ID_Batiment"];
    }

    function get_base_id($id_user){
        $conn = getConn();

        $sql = "SELECT * FROM base WHERE ID_User_FK = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $base = $result->fetch_assoc();
        return $base["ID_Base"];
    }

    function create_base($id_user){
        $conn = getConn();
        $sql = "INSERT INTO base (ID_User_FK, ressource) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $resource = 0;
        $stmt->bind_param("ii", $id_user, $resource);
        $stmt->execute();

        $id_base = get_base_id($id_user);
        
        $id_QG = get_QG();
        $nombre_batiment = 1;
        $sql = "INSERT INTO construire (ID_Base_FK, ID_Batiment_FK, nb_batiment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $id_base, $id_QG, $nombre_batiment);
        $stmt->execute();

        return $id_base;
    }

    function get_data_of_base($token){
        $data_token = verifyToken($token);
        if ($data_token == null) {
            return "Invalid token";
        }
        $id_base = $data_token->id_base;

        $conn = getConn();
        $sql = "SELECT * FROM construire WHERE ID_Base_FK = ?";
        $db = $conn->prepare($sql);
        $db->bind_param("i", $id_base);
        $db->execute();
        $result = $db->get_result();
        $batiment_base = array();
        while ($row = $result->fetch_assoc()) {
            $batiment_base[] = $row;
        }
        
        $batiment = array();
        foreach ($batiment_base as $bat) {
            $sql = "SELECT * FROM batiment WHERE ID_Batiment = ?";
            $db = $conn->prepare($sql);
            $db->bind_param("i", $bat["ID_Batiment_FK"]);
            $db->execute();
            $result = $db->get_result();
            $batiment[] = $result->fetch_assoc();
        }
        return json_encode($batiment);
    }