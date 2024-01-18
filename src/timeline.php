<?php
require_once("app/global.php");
require_once("data/documento_iniziale.php");
require_once("data/capitolo.php");
require_once("data/indagine.php");
require_once("components/sidebar.php");

if(!(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "")) {
    /*
    header("Location: accedi.php");
    exit();*/
}
if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];
    $case = getIndagineById($caseId);
    if(is_null($case)) {
        header("Location: 404.php");
        exit();
    }
    $documenti = getDocumentiInizialeByIndagine($caseId);

    $layout = file_get_contents("templates/layout.html");

    $title = 'Cronologia | '.$case->nome.' | Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; <a href="case.php?id='.$caseId.'">Presentazione</a> &raquo; Cronologia </p>';   
    $content = '<h1>'.$case->nome.'</h1>';
    foreach($documenti as $doc) {
        if($doc->tipo === TipoDocumento::cronologia) {
            $content.=$doc->contenuto;
        }
    }
    $menu = getSidebar("TIMELINE", $case->nome, $case->id);

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[sidebar]", $menu, $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
} else {
    header("Location: 404.php");
    exit();
}
?>