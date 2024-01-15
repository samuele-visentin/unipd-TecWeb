<?php
require_once("app/global.php");
require_once("data/documento_iniziale.php");
require_once("data/capitolo.php");	

if(!(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "")) {
    header("Location: accedi.php");
    exit();
}
if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];
    $documenti = getDocumentiInizialeByIndagine($caseId);
    $capitoli = getCapitoliByIndagine($caseId);
} else {
    header("Location: 404.php");
    exit();
}
