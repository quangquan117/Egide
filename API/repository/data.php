<?php

class Data_base {
    private $conn;
    public function __construct() {
        $this->conn = getConn();
    }
    function get_data($where) {
        $sql = "SELECT * FROM ".$where;
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function get_data_from_id($where, $type_id, $id) {
        $sql = "SELECT * FROM ".$where." WHERE ID_".$type_id." = ".$id;
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function find_user($email_or_pseudo) {
        $sql = "SELECT * FROM user WHERE pseudo = ? OR email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email_or_pseudo, $email_or_pseudo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function update_data($where, $id, $data) {
        if ($where == "batiment") {
            $stmt = $this->conn->prepare("UPDATE ".$where." SET ressource_par_minute = ?, point_de_vie = ?, defense = ?, prix = ?, description = ? WHERE ID_Batiment = ?");
            $stmt->bind_param("iiiisi", $data["ressource_par_minute"], $data["point_de_vie"], $data["defense"], $data["prix"], $data["description"], $id);
            $stmt->execute();
        } else if ($where == "soldat") {
            $stmt = $this->conn->prepare("UPDATE ".$where." SET point_de_vie = ?, attaque = ?, bonus_vs_infanterie = ?, bonus_vs_blinder = ?, bonus_vs_aeriens = ?, prix = ?, description = ?, ID_Batiment_FK = ? WHERE id = ?");
            $stmt->bind_param("iddddisii", $data["point_de_vie"], $data["attaque"], $data["bonus_vs_infanterie"], $data["bonus_vs_blinder"], $data["bonus_vs_aeriens"], $data["prix"], $data["description"], $data["batiment_lier"], $id);
            $stmt->execute();
        } else if ($where == "base") {
            $stmt = $this->conn->prepare("UPDATE ".$where." SET ressource = ? WHERE ID_Base = ?");
            $stmt->bind_param("ii", $data["ressource"], $id);
            $stmt->execute();
        }
        return "Update done";
    }
    function update_contruire($id_base, $id_batiment, $nb_batiment) {
        $sql = "UPDATE construire SET nb_batiment = ? WHERE ID_Base_FK = ? AND ID_Batiment_FK = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $nb_batiment, $id_base, $id_batiment);
        $stmt->execute();
        return "Update done";
    }
    function create_data($where, $data) {
        try {
            if ($where == "batiment") {
                $stmt = $this->conn->prepare("INSERT INTO ".$where." (ressource_par_minute, point_de_vie, defense, prix, description, nom) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiiss", $data["ressource_par_minute"], $data["point_de_vie"], $data["defense"], $data["prix"], $data["description"], $data["nom"]);
                $stmt->execute();
            } else if ($where == "type_soldat") {
                $stmt = $this->conn->prepare("INSERT INTO ".$where." (point_de_vie, attaque, bonus_vs_infanterie, bonus_vs_blinder, bonus_vs_aeriens, prix, description, ID_Batiment_FK, nom) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iddddisis", $data["point_de_vie"], $data["attaque"], $data["bonus_vs_infanterie"], $data["bonus_vs_blinder"], $data["bonus_vs_aeriens"], $data["prix"], $data["description"], $data["batiment_lier"], $data["nom"]);
                $stmt->execute();
            } else if ($where == "user") {
                $stmt = $this->conn->prepare("INSERT INTO ".$where." (pseudo, email, password, admin) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $data["pseudo"], $data["email"], $data["password"], $data["admin"]);
                $stmt->execute();
            } else if ($where == "construire") {
                $stmt = $this->conn->prepare("INSERT INTO ".$where." (ID_Base_FK, ID_Batiment_FK, nb_batiment) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $data["ID_Base_FK"], $data["ID_Batiment_FK"], $data["nb_batiment"]);
                $stmt->execute();
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    function delete_data($where, $id) {
        if ($where == "batiment") {
            $sql = "DELETE FROM ".$where." WHERE ID_Batiment = ".$id;
        } else if ($where == "type_soldat") {
            $sql = "DELETE FROM ".$where." WHERE ID_Soldat = ".$id;
        } else if ($where == "user") {
            $sql = "DELETE FROM ".$where." WHERE ID_User = ".$id;
        } else if ($where == "base") {
            $sql = "DELETE FROM ".$where." WHERE ID_Base = ".$id;
        }else if ($where == "construire") {
            $sql = "DELETE FROM ".$where." WHERE ID_Base_FK = ".$id;
        }
        $this->conn->query($sql);
        return "Delete done";
    }
}