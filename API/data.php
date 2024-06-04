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