<?php
require_once(__DIR__."/database.php");


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

function linkfy(string $in): string {
    return preg_replace('/\s+/', '%20', $in);
}

function to500($errno, $errstr = null) {
    global $BASE_URL;
    http_response_code(500);
    header("Location: " . $BASE_URL . "500.html");
    exit();
}

function getUserToolBar(bool $account = true) {
    if(isset($_SESSION['userId']) && $_SESSION['userId'] !== "") {
        $content = file_get_contents("templates/logout_layout.html");
        if($account) {
            if($_SESSION['isAdmin'])
                $content = str_replace("[account]", '<a href="account.php" lang="en">Account admin</a>', $content);
            else
                $content = str_replace("[account]", '<a href="account.php" lang="en">Account</a>', $content);
        } else {
            if($_SESSION['isAdmin'])
                $content = str_replace("[account]", '<span lang="en">Account admin</span>', $content);
            else
                $content = str_replace("[account]", '<span lang="en">Account</span>', $content);
        }
        return $content;
    }
    return file_get_contents("templates/login_layout.html");
}

//ritorna 1 se la password è valida
function check_password(string $password) {
    /*
- `^`: Questo simbolo indica l'inizio della stringa. 

- `(?=.*[a-z])`: Questa è una asserzione positiva lookahead. 
Significa che la password deve contenere almeno un carattere minuscolo.

- `(?=.*[A-Z])`: Questa è un'altra asserzione positiva lookahead. 
Significa che la password deve contenere almeno un carattere maiuscolo.

- `(?=.*\d)`: 
Questa asserzione verifica che la password contenga almeno un numero.

- `(?=.*[@$!%*?&])`: 
Questa asserzione verifica che la password contenga almeno uno dei 
seguenti caratteri speciali: @, $, !, %, *, ?, &.

- `[A-Za-z\d@$!%*?&]{8,25}`: 
Questa parte dell'espressione regolare verifica che la password sia 
lunga almeno 4 caratteri e che contenga solo caratteri alfanumerici 
e i caratteri speciali specificati.

- `$`: 
Questo simbolo indica la fine della stringa.
    */
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,25}$/';
    return preg_match($pattern, $password);
}

//ritorna 1 se l'username è valido
function check_username(string $username) {
    //username cosi continene solo lettere numeri e underscore tra 4 e 16 char
    $pattern = '/^[a-zA-Z0-9_]{4,16}$/';
    return preg_match($pattern, $username);
}

set_error_handler('to500');
set_exception_handler('to500');
?>