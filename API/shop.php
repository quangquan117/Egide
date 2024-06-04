<?php
    function get_shop($type_shop) {
        $conn = getConn();
        $sql = "SELECT * FROM ".$type_shop;
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }