<?php
$SERVER_NAME = $_SERVER['SERVER_NAME'];
$SERVER_PORT = $_SERVER['SERVER_PORT'];
$BASE_URL = "http://{$SERVER_NAME}:{$SERVER_PORT}/";

session_start();

function to500($errno, $errstr = null) {
    global $BASE_URL;
    http_response_code(500);
    header("Location: {$BASE_URL}500.php");
    exit();
}

set_error_handler('to500');
set_exception_handler('to500');

?>