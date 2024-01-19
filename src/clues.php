<?php
require_once("app/global.php");
require_once("data/prova.php");
require_once("data/capitolo.php");
require_once("data/indagine.php");
require_once("data/salvataggio.php");
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
    $salvataggio = getSalvataggioByUtenteAndIndagine($_SESSION["userId"], $caseId);
    //$salvataggio = getSalvataggioByUtenteAndIndagine(0, $caseId);
    if(!is_null($salvataggio)) {
        $prove = getProveBySalvataggio($salvataggio, $caseId);
    } else {
        $prove = getProveByIndagineAndProgressivoCapitolo($caseId, 0);
    }

    $layout = file_get_contents("templates/layout.html");
    $clueLayout = file_get_contents("templates/clue_layout.html");

    $title = 'Indizi | '.$case->nome.' | Clue Catchers';
    $keywords = '';
    $description = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; <a href="case.php?id='.$caseId.'">Presentazione</a> &raquo; Indizi </p>';   
    $content = '<h1>'.$case->nome.'</h1>';
    foreach($prove as $prova) {
        if($prova->tipo === TipoProva::indizio || $prova->tipo === TipoProva::evento) {
            $clue = str_replace("[titolo]", $prova->titolo, $clueLayout);
            $clue = str_replace("[contenuto]", $prova->contenuto, $clue);
            $content.=$clue;
        }
    }
    $menu = getSidebar("CLUES", $case->nome, $case->id);

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