<?php
require_once("../data/utente.php");
require_once("global.php");

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

function check_username(string $username) {
    //username cosi continene solo lettere numeri e underscore tra 4 e 16 char
    $pattern = '/^[a-zA-Z0-9_]{4,16}$/';
    return preg_match($pattern, $username);
}

if( $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["username"]) && $_POST["username"] !== ""
    && isset($_POST["password"]) && $_POST["password"] !== ""
    && isset($_POST["confermaPassword"]) && $_POST["confermaPassword"] !== "") {
    
    $username = secure_input($_POST["username"]);
    $password = $_POST["password"];
    $params = "";
    if(check_username($username) === false) {
        $params .= "error=1";
    }
    else if(check_password($password) === false) {
        $params .= "error=2";
    } else if($password !== $_POST["confermaPassword"]) {
        $params .= "error=3";
    } else {
        $res = getUtenteByUsername($username);
        if($res !== null) {
            $params .= "error=5";
        }
    }
    if($params !== "") {
        header("Location: ../registrati.php?{$params}#error-message");
        exit();
    }
    insertUtente($username, $password);
    $user = getUtenteByUsername($username);
    $_SESSION["userId"] = $user->id;
    $_SESSION["isAdmin"] = $user->is_admin;
    header("Location: ../cases.php");
} else {
    header("Location: ../registrati.php?error=4#error-message");
    exit();
}

