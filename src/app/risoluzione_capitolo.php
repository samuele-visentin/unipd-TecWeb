<?php
require_once("global.php");
require_once("../data/indagine.php");
require_once("../data/domanda.php");
require_once("../data/salvataggio.php");

if(isset($_GET["id"]) && $_GET["id"] !== "" && isset($_GET["chapter"]) && $_GET["chapter"] !== "") {
    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        $caseId = $_GET["id"];
        $chapter = $_GET["chapter"];
        $userId = (int)$_SESSION["userId"];
        $case = getIndagineById($caseId);

        $domande = array();
        $domande = getDomandeByIndagineAndProgressivoCapitolo($caseId,$chapter);

        $params = "";
        for ($i = 0; $i < count($domande); $i++) {
            if(is_null($domande[$i])) continue;
            
            $domanda = $domande[$i];
            $rispostaData = $_POST[$domanda->id];

            if(!$rispostaData){
                $params .= 'domande['.$i.']='.$domanda->progressivo.'&';
            }
        }

        $params = rtrim($params,'&');

        // Domande errate
        if($params !== "") {
            header("Location: ../chapter.php?id={$caseId}&chapter={$chapter}&error=invalidDomande#error-message");
            exit();
        }

        insertSalvataggio($userId, $caseId, array_values($domande)[count($domande)-1]);
        header("Location: ../case.php?id={$caseId}");
    }
} else {
    header("Location: 404.html");
    exit();
}
?>