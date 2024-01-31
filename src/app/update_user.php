<?php

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit();
}

require_once("global.php");
require_once("../data/utente.php");

if(isset($_POST['username'])) {
    $username = secure_input($_POST["username"]);
    $params = "";
    if(check_username($username) !== 1) {
        $params .= "error=username";
    } else {
        $res = getUtenteByUsername($username);
        if($res !== null) {
            $params .= "error=userNotValide";
        }
    }
    if($params !== "") {
        header("Location: ../account.php?{$params}#error-message");
        exit();
    }
    updateUsername($_SESSION["userId"], $username);
    $_SESSION["username"] = $username;
    header("Location: ../account.php");
    exit();
}
if(isset($_POST['password']) && isset($_POST['confermaPassword'])) {
    $password = $_POST["password"];
    $params = "";
    if(check_password($password) !== 1) {
        $params .= "error=password";
    } else if($password !== $_POST["confermaPassword"]) {
        $params .= "error=passwordNotSame";
    } 
    if($params !== "") {
        header("Location: ../account.php?{$params}#error-message");
        exit();
    }
    updatePassowrd($_SESSION["userId"], $password);
    header("Location: ../account.php");
    exit();
}
header("Location: ../index.php");
?>