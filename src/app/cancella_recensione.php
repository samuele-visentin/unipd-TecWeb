<?php

require_once("global.php");
require_once("../data/recensione.php");

if(!(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "")) {
    header("Location: accedi.php");
    exit();
}

if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        removeRecensione($_SESSION["userId"], $caseId);
        header("Location: ../chapter.php?id=".$caseId."&savedRecensioni=1#conferma");
        exit();
    }
} else {
    header("Location: 404.html");
    exit();
}
?>