<?php
    include_once "config.php";

    function getConn() {
        $file = file_get_contents($GLOBALS['DB_CONFIG_PATH']);
        $json = json_decode($file, true);

        $conn = new mysqli($json["db_host"], $json["db_user"], $json["db_pass"], $json["db_name"]);
        return $conn;
    }
    