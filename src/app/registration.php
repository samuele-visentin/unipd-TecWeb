<?php
require_once("../data/utente.php");
require_once("global.php");

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
    $_SESSION["username"] = $user->username;
    header("Location: ../cases.php");
} else {
    header("Location: ../registrati.php?error=4#error-message");
    exit();
}

