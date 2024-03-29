<?php
require_once("app/global.php");
require_once("data/prova.php");
require_once("data/capitolo.php");
require_once("data/indagine.php");
require_once("data/capitolo.php");
require_once("data/salvataggio.php");
require_once("components/sidebar.php");

if(!isset($_SESSION['userId']) || $_SESSION['userId'] === "") {
    $target = $_SERVER["REQUEST_URI"];
    header("Location: accedi.php?target={$target}&error=notLogged#error-message");
    exit();
}
if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];
    $userId = (int)$_SESSION["userId"];
    $case = getIndagineById($caseId);
    if(is_null($case)) {
        header("Location: 404.html");
        exit();
    }
    $lastChapt = getLastCapitoloByUtenteAndIndagine($userId, $caseId);
    //$lastChapt = 5;
    $prove = array();
    $capitoli = array();
    if(!is_null($lastChapt)) {
        for ($i = 0; $i <= $lastChapt; $i++) { 
            $capitoli[$i] = getCapitoloByIndagineAndProgressivo($caseId, $i);
            $prove[$i] = getProveByIndagineAndProgressivoCapitolo($caseId, $i);
        }
    } else {
        if(isFinished($userId, $caseId)) {
            $lastChapt = getFinalCapitolo($caseId);
            for ($i = 0; $i <= $lastChapt; $i++) { 
                $capitoli[$i] = getCapitoloByIndagineAndProgressivo($caseId, $i);
                $prove[$i] = getProveByIndagineAndProgressivoCapitolo($caseId, $i);
            }
        } else {
            $capitoli[0] = getCapitoloByIndagineAndProgressivo($caseId, 0);
            $prove[0] = getProveByIndagineAndProgressivoCapitolo($caseId, 0);
        }        
    }
    $layout = file_get_contents("templates/layout.html");
    $clueLayout = file_get_contents("templates/clue_layout.html");
    $clueGroupLayout = file_get_contents("templates/clues_group_layout.html");   

    $title = 'Indizi | '.$case->nome.' | Clue Catchers';
    $keywords = 'Clue Catchers, '.$case->nome. ', indizi';
    $description = 'Visualizza gli indizi del caso '.$case->nome.'.';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; <a href="case.php?id='.$caseId.'">Presentazione</a> &raquo; Indizi </p>';   
    $content = '<h1>'.$case->nome.'</h1>';
    $imageCounter = 0;
    for ($i = 0; $i < count($capitoli); $i++) { 
        if(is_null($prove[$i])) continue;     
        $clueContent = "";        
        foreach($prove[$i] as $prova) {
            if($prova->tipo === TipoProva::indizio || $prova->tipo === TipoProva::evento) {
                $clue = str_replace("[titolo]", $prova->titolo, $clueLayout);
                $clue = str_replace("[contenuto]", $prova->contenuto, $clue);
                if(is_null($prova->image_path)) {
                    $clue = str_replace("[immagine]", "", $clue);
                } else {
                    $clue = str_replace("[immagine]", '<img alt="" class="zoomImg" src="assets/'.$prova->image_path.'">', $clue);
                    $imageCounter++;
                }
                $clueContent.=$clue;
            }
        }
        if(!($clueContent === "")) {
            $groupLayout = str_replace("[capitolo]", 'Capitolo '.$i.': '.$capitoli[$i]->titolo, $clueGroupLayout);
            $groupLayout = str_replace("[contenuto]", $clueContent, $groupLayout);
            $content .= $groupLayout;
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
    header("Location: 404.html");
    exit();
}
?>