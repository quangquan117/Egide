<?php
    function get_data($type_data) {
        $conn = getConn();
        $sql = "SELECT * FROM ".$type_data;
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function get_data_from_id($type_data, $id) {
        $conn = getConn();
        $sql = "SELECT * FROM ".$type_data." WHERE id = ".$id;
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
            $stmt->bind_param("iddddisii", $data["point_de_vie"], $data["attaque"], $data["bonus_vs_infanterie"], $data["bonus_vs_blinder"], $data["bonus_vs_aeriens"], $data["prix"], $data["description"], $data["ID_Batiment_FK"], $id);
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
        } else if ($type_data == "soldat") {
            $stmt = $conn->prepare("INSERT INTO ".$type_data." (point_de_vie, attaque, bonus_vs_infanterie, bonus_vs_blinder, bonus_vs_aeriens, prix, description, ID_Batiment_FK, nom) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iddddisis", $data["point_de_vie"], $data["attaque"], $data["bonus_vs_infanterie"], $data["bonus_vs_blinder"], $data["bonus_vs_aeriens"], $data["prix"], $data["description"], $data["ID_Batiment_FK"], $data["nom"]);
            $stmt->execute();
            return "Create done";
        }
    }