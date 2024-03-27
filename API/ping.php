<?php
    if (strpos($_SERVER["REQUEST_URI"], "/ping") !== false) {
        echo "pong";
        http_response_code(200);
    } else {
        echo "test fail";
        http_response_code(404);
    }