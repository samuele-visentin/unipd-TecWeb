<?php
require_once("database.php");

$SERVER_NAME = $_SERVER['SERVER_NAME'];
$SERVER_PORT = $_SERVER['SERVER_PORT'];
$BASE_URL = "http://{$SERVER_NAME}:{$SERVER_PORT}/";
$DB = new DatabaseAccess();
$TITLE = "Clue Catchers";
session_start();

function is_logged_in(): bool {
    return isset($_SESSION["userId"]);
}

function secure_input(string $in): string {
    return htmlentities(strip_tags(trim($in)));
}

function to500($errno, $errstr = null) {
    global $BASE_URL;
    http_response_code(500);
    header("Location: {$BASE_URL}500.php");
    exit();
}

function getUserToolBar() {
    if(isset($_SESSION['userId']) && $_SESSION['userId'] !== "") {
        return file_get_contents("templates/logout_layout.html");
    }
    return file_get_contents("templates/login_layout.html");
}

//set_error_handler('to500');
//set_exception_handler('to500');
?>