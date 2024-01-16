<?php
require_once("app/global.php");
require_once("data/documento_iniziale.php");
require_once("data/capitolo.php");
require_once("data/indagine.php");

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

    $title = $case->nome.' | Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; '.$case->nome.'</p>';   
    $content = '<h1>'.$case->nome.'</h1>';
    foreach($documenti as $doc) {
        if($doc->tipo === TipoDocumento::lettera) {
            $content.=$doc->contenuto;
        }
    }
    $menu = '
        <p class="menuSection">Generale</p>
        <ul>
            <li id="menuButton-home"><a href="index.php" lang="en">Home</a></li>
            <li id="menuButton-cases"><a href="cases.php">I nostri casi</a></li>
            <li id="menuButton-about"><a href="about.html">Chi siamo</a></li>
            <li id="menuButton-faq"><a href="faq.html" lang="en"><abbr title="Frequently Asked Questions">FAQ</abbr></a></li>
        </ul>
        <p class="menuSection">'.$case->nome.'</p>
        <ul>
            <li class="menuSelected" id="menuButton-letter">Presentazione</li>
            <li id="menuButton-timeline"><a href="timeline.php?id='.$case->id.'">Cronologia</a></li>
        </ul>
    ';

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $content, $page);
    $page = str_replace("[menu]", $menu, $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;
} else {
    header("Location: 404.php");
    exit();
}
?>