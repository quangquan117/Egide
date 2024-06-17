<?php
    include_once ("token.php");

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

    function get_data_of_base($token) {
        $data_base = new Data_base();
        $data_token = verifyToken($token);
        if ($data_token == null) {
            return "Invalid token";
        }

        $id_base = $data_token->id_base;
        $result = $data_base->get_data_from_id("construire", "ID_Base_FK", $id_base);
        $batiment_base = array();
        foreach ($result as $row) {
            $batiment_base[] = $row;
        }

        $batiment = array();
        foreach ($batiment_base as $bat) {
            $result = $data_base->get_data_from_id("batiment", "Batiment", $bat["ID_Batiment_FK"]);
            $batiment[] = $result[0];
        }
        return json_encode($batiment);
    }

    function buy_something($type, $id, $token) {
        $data_base = new Data_base();
        $data_token = verifyToken($token);
        if ($data_token == null) {
            return "Invalid token";
        }

        $base = $data_base->get_data_from_id("base", "Base", $data_token->id_base)[0];

        $batiment = $data_base->get_data_from_id("batiment", "Batiment", $id)[0];
        if ($batiment == null) {
            return "Invalid batiment";
        }
        if ((int)$base["ressource"] < (int)$batiment["prix"]) {
            return "Not enough ressource";
        }
        $new_ressource = (int) $base["ressource"] -= (int) $batiment["prix"];
        $base["ressource"] = $new_ressource;

        $data_base->update_data("base", $data_token->id_base, $base);
        $contruire = $data_base->get_data_from_id("construire", "Base_FK", $data_token->id_base);
        for ($i = 0; $i < count($contruire); $i++) {
            if ($contruire[$i]["ID_Batiment_FK"] == $id) {
                $contruire[$i]["nb_batiment"] += 1;
                if ($data_base->update_contruire($data_token->id_base, $id, $contruire[$i]["nb_batiment"]) == "Update done") {
                    return "Buy done";
                } else {
                    return "Update failed";
                }
            }
        }
        $data_base->create_data("construire", ["ID_Base_FK" => $data_token->id_base, "ID_Batiment_FK" => $id, "nb_batiment" => 1]);
        return "Buy done";
    }