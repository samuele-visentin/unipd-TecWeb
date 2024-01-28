<?php
require_once("app/global.php");
require_once("data/domanda.php");
require_once("data/risposta.php");
require_once("data/indagine.php");
require_once("data/salvataggio.php");
require_once("components/sidebar.php");

if(!(isset($_SESSION["userId"]) && $_SESSION["userId"] !== "")) {
    header("Location: accedi.php");
    exit();
}

if(isset($_GET["id"]) && $_GET["id"] !== "" && isset($_GET["chapter"]) && $_GET["chapter"] !== "") {
    $caseId = $_GET["id"];
    $chapter = $_GET["chapter"];
    $userId = (int)$_SESSION["userId"];
    $case = getIndagineById($caseId);
    
    $domande = array();
    $domande = getDomandeByIndagineAndProgressivoCapitolo($caseId,$chapter);

    $layout = file_get_contents("templates/layout.html");
    $chapterQuestionsLayout = file_get_contents("templates/chapter_questions_layout.html");
    $chapterContent = file_get_contents("templates/chapter_layout.html");

    $title = 'Capitolo '.$chapter.' | '.$case->nome.' | Clue Catchers';
    $keywords = '';
    $description = '';
    $content = '';
    $breadcrumbs = '<p><a href="index.php" lang="en">Home</a> &raquo; <a href="cases.php">I nostri casi</a> &raquo; <a href="case.php?id='.$caseId.'">Presentazione</a> &raquo; Capitolo '.$chapter.' </p>';   
    $chapterContent = str_replace("[title]", '<h1>'.$case->nome.'</h1>', $chapterContent);
    
    for ($i = 0; $i < count($domande); $i++) { 
        if(is_null($domande[$i])) continue;
        
        $domanda = $domande[$i];
        $risposte = getRisposteByIdDomanda($domanda->id);

        $answerContent =""; 
        $questionContent = "";  
        for ($j = 0; $j < count($risposte); $j++) {
            if(is_null($risposte[$j])) continue;
            $risposta = $risposte[$j];

            $answerContent .= '<div>
                <input type="radio" name="'.$domanda->id.'" id="'.$risposta->id_domanda.'" value="'.$risposta->is_correct.'" [aria] required>
                <label for="'.$risposta->id_domanda.'">'.$risposta->contenuto.'</label>
            </div>';
        }

        if(!($answerContent === "")) {
            $question = str_replace("[domanda]", $domanda->progressivo.'. '.$domanda->contenuto, $chapterQuestionsLayout);
            $question = str_replace("[risposta]", $answerContent, $question);
            $questionContent .= $question;
            $content.= $questionContent;
        }  

    }

    $chapterContent = str_replace("[domande]", $content, $chapterContent);
    
    $menu = getSidebar("CHAPTER", $case->nome, $case->id);

    $page = str_replace("[title]", $title, $layout);
    $page = str_replace("[keywords]", $keywords, $page);
    $page = str_replace("[description]", $description, $page);
    $page = str_replace("[breadcrumbs]", $breadcrumbs, $page);
    $page = str_replace("[content]", $chapterContent, $page);
    $page = str_replace("[sidebar]", $menu, $page);
    $page = str_replace("[userToolbar]", getUserToolBar(), $page);

    echo $page;


} else {
    header("Location: 404.html");
    exit();
}
?>