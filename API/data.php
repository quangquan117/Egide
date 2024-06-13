<?php
    function get_data($type_data, $sql = null) {
        $conn = getConn();
        if ($sql == null)
            $sql = "SELECT * FROM ".$type_data;
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function get_data_from_id($type_data, $id) {
        $conn = getConn();
        if ($type_data == "batiment")
            $type_id = "ID_Batiment";
        else if ($type_data == "soldat")
            $type_id = "ID_Soldat";
        $sql = "SELECT * FROM ".$type_data." WHERE ".$type_id." = ".$id;
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function update_data($type_data, $id, $data) {
        $conn = getConn();
        if ($type_data == "batiment") {
            $stmt = $conn->prepare("UPDATE ".$type_data." SET ressource_par_minute = ?, point_de_vie = ?, defense = ?, prix = ?, description = ? WHERE ID_Batiment = ?");
            $stmt->bind_param("iiiisi", $data["ressource_par_minute"], $data["point_de_vie"], $data["defense"], $data["prix"], $data["description"], $id);
            $stmt->execute();
            return "Update done";
        } else if ($type_data == "soldat") {
            $stmt = $conn->prepare("UPDATE ".$type_data." SET point_de_vie = ?, attaque = ?, bonus_vs_infanterie = ?, bonus_vs_blinder = ?, bonus_vs_aeriens = ?, prix = ?, description = ?, ID_Batiment_FK = ? WHERE id = ?");
            $stmt->bind_param("iddddisii", $data["point_de_vie"], $data["attaque"], $data["bonus_vs_infanterie"], $data["bonus_vs_blinder"], $data["bonus_vs_aeriens"], $data["prix"], $data["description"], $data["batiment_lier"], $id);
            $stmt->execute();
            return "Update done";
        }
    }
    function create_data($type_data, $data) {
        $conn = getConn();
        if ($type_data == "batiment") {
            $stmt = $conn->prepare("INSERT INTO ".$type_data." (ressource_par_minute, point_de_vie, defense, prix, description, nom) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiiss", $data["ressource_par_minute"], $data["point_de_vie"], $data["defense"], $data["prix"], $data["description"], $data["nom"]);
            $stmt->execute();
            return "Create done";
        } else if ($type_data == "type_soldat") {
            $stmt = $conn->prepare("INSERT INTO ".$type_data." (point_de_vie, attaque, bonus_vs_infanterie, bonus_vs_blinder, bonus_vs_aeriens, prix, description, ID_Batiment_FK, nom) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iddddisis", $data["point_de_vie"], $data["attaque"], $data["bonus_vs_infanterie"], $data["bonus_vs_blinder"], $data["bonus_vs_aeriens"], $data["prix"], $data["description"], $data["batiment_lier"], $data["nom"]);
            $stmt->execute();
            return "Create done";
        }
        return "Create failed";
    }
    function delete_data($type_data, $id) {
        $conn = getConn();
        if ($type_data == "batiment") {
            $sql = "DELETE FROM ".$type_data." WHERE ID_Batiment = ".$id;
        } else if ($type_data == "type_soldat") {
            $sql = "DELETE FROM ".$type_data." WHERE ID_Soldat = ".$id;
        }
        $conn->query($sql);
        return "Delete done";
    }
    function buy_something($type_data, $id, $token) {
        $conn = getConn();
        $data_token = verifyToken($token);
        if (!$data_token)
            return "Invalid token";
        $data_token = (array) $data_token;
        //get base
        $base = get_data($data_token["id_base"], "SELECT * FROM base WHERE ID_Base = ".$data_token["id_base"])[0];

        //get batiment selectionner
        $batiment = get_data($type_data, "SELECT * FROM ".$type_data." WHERE ID_Batiment = ".$id)[0];
        if ($batiment == null)
            return "Invalid batiment";
        if ((int)$base["ressource"] < (int)$batiment["prix"])
            return "Not enough ressource";
        $new_ressource = (int) $base["ressource"] -= (int) $batiment["prix"];

        //update base, request prepare
        $sql = "UPDATE base SET ressource = ? WHERE ID_Base = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_ressource, $data_token["id_base"]);
        $sql = "INSERT INTO construire (ID_Base_FK, ID_Batiment_FK) VALUES (".$data_token["id_base"].", ".$id.")";
        $conn->query($sql);
        return "Buy done";
    }