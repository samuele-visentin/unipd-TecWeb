<?php
require_once("global.php");
require_once("../data/utente.php");

if(!isset($_SESSION["userId"])) {
    // Verifica se il form di login è stato inviato
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera i dati inseriti dall'utente
        $username = $_POST["username"];
        $password = $_POST["password"];
        $user = login($username, $password);
        if($user === null) {
            // Login fallito, restituisci un messaggio di errore
            $target = "";
            if(isset($_GET["target"]) && $_GET["target"] !== "") {
                $target = "&target={$_GET["target"]}";
            }
            header("Location: ../accedi.php?error=invalid{$target}#error-message");
            exit();
        }
        $_SESSION["userId"] = $user->id;
        $_SESSION["isAdmin"] = $user->is_admin;
        $_SESSION["username"] = $user->username;
        if(isset($_GET["target"]) && $_GET["target"] !== "") {
            header("Location: {$_GET["target"]}");
        } else {
            header("Location: ../cases.php");
        }
    } else {
        header("Location: ../accedi.php");
    }
} else {
    header("Location: ../cases.php");
}
?>
