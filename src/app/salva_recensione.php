<?php

require_once("global.php");
require_once("../data/recensione.php");

if(!(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "")) {
    header("Location: accedi.php");
    exit();
}

if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["review"]) && $_POST["review"] !== "") {
        if(strlen($_POST["review"]) > 255) {
            header('Location: ../chapter.php?id='.$caseId.'&errorRecensione=StringOverflow#error-message');
            exit();
        }
        saveRecensione($_SESSION["userId"], $caseId, $_POST["review"]);
        header("Location: ../chapter.php?id=".$caseId."&savedRecensioni=1#conferma");
        exit();
    } else {
        header('Location: ../chapter.php?id='.$caseId.'&errorRecensione=StringEmpty#error-message');
        exit();
    }
} else {
    header("Location: 404.html");
    exit();
}
?>