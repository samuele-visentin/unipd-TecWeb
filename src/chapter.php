<?php
require_once("app/global.php");
require_once("data/domanda.php");
require_once("data/risposta.php");
require_once("data/recensione.php");
require_once("data/indagine.php");
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

    if(isFinished($userId, $caseId)) {
        $recensione = getRecensioneByIndagineAndUtente($caseId, $userId);
        $cancella = '';
        if(is_null($recensione)) {
            $recensione = "";            
        } else {
            $recensione = $recensione->contenuto;
            $cancella = '<form action="app/cancella_recensione.php?id='.$case->id.'" method="post">
                            <input type="submit" value="Elimina">
                        </form>';
        }

        $title = 'Conclusioni | '.$case->nome.' | Clue Catchers';
        $keywords = 'Conclusioni, Clue Catchers, '.$case->nome;
        $description = 'Vai alle conclusioni dell\'indagine '.$case->nome;
        $content = file_get_contents("templates/conclusioni_layout.html");
        $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; <a href="case.php?id='.$caseId.'">Presentazione</a> &raquo; Conclusioni </p>';
        $layout = file_get_contents("templates/layout.html");

        $content = str_replace("[caseTitle]", $case->nome, $content);
        $content = str_replace("[text]", $recensione, $content);
        $content = str_replace("[actionSave]", "app/salva_recensione.php?id=".$case->id, $content);
        if(isset($_GET["savedRecensioni"]) && $_GET["savedRecensioni"] == 1) {
            $content = str_replace("[conferma]", '<p id="conferma">La risposta è stata salvata. Grazie del tuo contributo, detective!</p>', $content);
        } else {
            $content = str_replace("[conferma]", "", $content);
        }

        $page = str_replace("[content]", $content, $layout);
        $page = str_replace("[cancella]", $cancella, $page);
        $page = str_replace("[caseTitle]", $case->nome, $page);
        $page = str_replace("[title]", $title, $page);
        $page = str_replace("[keywords]", $keywords, $page);
        $page = str_replace("[description]", $description, $page);
        $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
        $page = str_replace("[userToolbar]", getUserToolBar(), $page);
        $menu = getSidebar("CHAPTER", $case->nome, $case->id);
        $page = str_replace("[sidebar]", $menu, $page);
        if(isset($_GET["errorRecensione"])) {
            if($_GET["errorRecensione"] === "StringOverflow") {
                $page = str_replace("[errorRecensione]", '<p id="error-message">Recensione troppo lunga. Massimo 255 caratteri.</p>', $page);
            } else if ($_GET["errorRecensione"] === "StringEmpty") {
                $page = str_replace("[errorRecensione]", '<p id="error-message">Recensione vuota.</p>', $page);
            } else {
                $page = str_replace("[errorRecensione]", '<p id="error-message">Errore nel salvataggio. Riprova.</p>', $page);
            }            
        } else {
            $page = str_replace("[errorRecensione]", '', $page);
        }

        echo $page;

        exit();
    }
    
    $domanda = getDomandaBySalvataggio($caseId, $userId);    
    if(!is_null($domanda)) {
        $chapter = getCapitoloByDomanda($domanda->id);
    } else {
        $chapter = getCapitoloByIndagineAndProgressivo($caseId, 0);
        $domanda = getFirstDomandaForIndagine($caseId);
    }

    $title = $chapter->titolo.' | '.$case->nome.' | Clue Catchers';
    $keywords = 'Capitolo '.$chapter->titolo.', Clue Catchers, '.$case->nome;
    $description = 'Vai al Capitolo '.$chapter->titolo.' dell\'indagine '.$case->nome;
    $content = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; <a href="case.php?id='.$caseId.'">Presentazione</a> &raquo; Capitolo: '.$chapter->titolo.' </p>';

    $layout = file_get_contents("templates/layout.html");

    $risposte = getRisposteByIdDomanda($domanda->id);

    $actionUrl = 'app/risoluzione_capitolo.php?id='.$caseId.'&idDomanda='.$domanda->id;

    $chapterQuestionsLayout = file_get_contents("templates/chapter_questions_layout.html");

    $content = str_replace("[title]", $chapter->titolo, $chapterQuestionsLayout);
    $content = str_replace("[content]", $chapter->descrizione, $content);
    $content = str_replace("[question]", $domanda->contenuto, $content);
    $content = str_replace("[actionForm]", $actionUrl, $content);
    $answerLayout = '<div class="answerContainer"><input type="radio" id="r_[prog]" name="domanda" value="[idRisposta]" required><label for="r_[prog]">[risposta]</label></div>';
    $answers = "";
    for ($i=0; $i < count($risposte); $i++) { 
        $answerContent = str_replace("[prog]", $i, $answerLayout);
        $answerContent = str_replace("[idRisposta]", $risposte[$i]->id, $answerContent);
        $answerContent = str_replace("[risposta]", $risposte[$i]->contenuto, $answerContent);
        $answers .= $answerContent;
    }
    $content = str_replace("[risposte]", $answers, $content);

    $page = str_replace("[content]", $content, $layout);
    $page = str_replace("[title]", $title, $page);
    $page = str_replace("[caseTitle]", $case->nome, $page);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);
    $menu = getSidebar("CHAPTER", $case->nome, $case->id);
    $page = str_replace("[sidebar]", $menu, $page);
    if(isset($_GET["error"]) && $_GET["error"] !== "") { 
        $page = str_replace("[errorMessage]", '<p id="error-message">La risposta è errata.</p>', $page);
    } else {
        $page = str_replace("[errorMessage]", '', $page);
    }
    
    echo $page;
}
?>