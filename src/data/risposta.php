
<?php
require_once("../app/global.php");
require_once("../app/database.php");

class Risposta {
    public string $id;
    public int $codice;
    public string $id_domanda;
    public bool $is_correct;
    public string $contenuto;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
        $this->codice = $row["codice"];
        $this->contenuto = $row["contenuto"];
        $this->id_domanda = $row["idDomanda"];
        $this->is_correct = (bool)$row["isCorrect"];
    }
}

function getAllRisposta() {
    global $DB;
    $result = $DB->query("SELECT * FROM risposta");
    while ($row = $result->fetch_assoc()) {
        $risposte[] = new Risposta($row);
    }
    return $risposte;
}

function getRispostaByIdDomanda(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM risposta WHERE idDomanda = ? 
        order by codice asc", array("s", $id));
    while ($row = $result->fetch_assoc()) {
        $risposte[] = new Risposta($row);
    }
    return $risposte;
}
?>