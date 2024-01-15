<?php
require_once("global.php");
require_once("../data/utente.php");

// Verifica se il form di login è stato inviato
if($_SESSION["userId"] === null) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera i dati inseriti dall'utente
        $username = $_POST["username"];
        $password = $_POST["password"];
        $user = login($username, $password);
        if($user === null) {
            // Login fallito, restituisci un messaggio di errore
            header("Location: ../accedi.php?error=1");
            exit();
        }
        $_SESSION["userId"] = $user->id;
        $_SESSION["isAdmin"] = $user->is_admin;
        if(isset($_POST["target"]) && $_POST["target"] !== "") {
            header("Location: {$_POST["target"]}");
        } else {
            header("Location: ../cases.php");
        }
    }
} else {
    header("Location: ../cases.php");
}
?>
