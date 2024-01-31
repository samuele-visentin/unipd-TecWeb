<?php
require_once("global.php");
require_once("../data/indagine.php");
require_once("../data/domanda.php");
require_once("../data/risposta.php");
require_once("../data/salvataggio.php");

if(isset($_GET["id"]) && $_GET["id"] !== "") {
    $caseId = $_GET["id"];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["domanda"]) && $_POST["domanda"] !== "")  {
        $idDomanda = $_GET["idDomanda"];
        $userId = (int)$_SESSION["userId"];
        $idRisposta = $_POST["domanda"];
        $risposta = getRispostaById($idRisposta);

        if ($risposta->is_correct) {
            $next = getNextDomandaByIdDomanda($idDomanda);
            echo (is_null($next)) ? "null" : $next->id;
            if(is_null($next)) {
                destroySalvataggio($userId, $caseId);
            } else {
                insertSalvataggio($userId, $caseId, $next);
            }            
            header("Location: ../chapter.php?id={$caseId}");
        } else {
            header("Location: ../chapter.php?id={$caseId}&error=invalidDomande#error-message");
            exit();
        }
    } else {
        header("Location: ../chapter.php?id={$caseId}&error=invalidDomande#error-message");
        exit();
    }
} else {
    header("Location: 404.html");
    exit();
}
?>