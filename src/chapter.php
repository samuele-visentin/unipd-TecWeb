<?php
require_once("app/global.php");
require_once("data/domanda.php");
require_once("data/indagine.php");
require_once("data/salvataggio.php");
require_once("components/sidebar.php");

if(!(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "")) {
    header("Location: accedi.php");
    exit();
}

if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];
    $case = getIndagineById($caseId);
    if(is_null($case)) {
        header("Location: 404.html");
        exit();
    }
}
?>