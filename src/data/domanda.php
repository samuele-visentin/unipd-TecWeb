<?php
require_once(__DIR__."/capitolo.php");

class Domanda {
    public string $id;
    public string $id_capitolo;
    public string $contenuto;
    public int $progressivo;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
        $this->progressivo = $row["progressivo"];
        $this->contenuto = $row["contenuto"];
        $this->id_capitolo = $row["idCapitolo"];
    }
}

function getAllDomanda() {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda order by progressivo asc");
    while ($row = $result->fetch_assoc()) {
        $domande[] = new Domanda($row);
    }
    return $domande;
}

function getDomandeByIndagineAndProgressivoCapitolo(string $idIndagine, int $progressivoCapitolo) {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE idCapitolo = 
    (SELECT id FROM capitolo WHERE idIndagine = ? AND progressivo = ?);", 
    array("si", $idIndagine, $progressivoCapitolo));
    $domande = array();
    while ($row = $result->fetch_assoc()) {
        $domande[] = new Domanda($row);
    }
    return (!empty($domande)) ? $domande : null;
}

function getDomandaById(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE id = ?", 
        array("s", $id));
    $row = $result->fetch_assoc();
    return new Domanda($row);
}

function getDomandaBySalvataggio(string $idIndagine, int $idUtente) {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE id = (SELECT idDomanda FROM salvataggio WHERE idIndagine = ? AND idUtente = ?)", 
        array("si", $idIndagine, $idUtente));
    $row = $result->fetch_assoc();
    return !is_null($row) ? new Domanda($row) : null;
}

function getFirstDomandaForIndagine(string $idIndagine) {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE progressivo = 1 AND idCapitolo = (SELECT id FROM capitolo WHERE idIndagine = ? AND progressivo = 0)", 
        array("s", $idIndagine));
    $row = $result->fetch_assoc();
    return !is_null($row) ? new Domanda($row) : null;
}

function getNextDomandaByIdDomanda(string $idDomanda) {
    $domanda = getDomandaById($idDomanda);
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE idCapitolo = ? AND progressivo = ? + 1", 
        array("si", $domanda->id_capitolo, $domanda->progressivo));
    $row = $result->fetch_assoc();
    if(is_null($row)) {
        $oldCapitolo = getCapitoloById($domanda->id_capitolo);
        $newCapitolo = getNextCapitoloByIdIndagineAndProgressivo($oldCapitolo->id_indagine, $oldCapitolo->progressivo);
        if(!is_null($newCapitolo)) {
            $result = $DB->query("SELECT * FROM domanda WHERE idCapitolo = ? AND progressivo = 1", 
                array("s", $newCapitolo->id));
            $row = $result->fetch_assoc();
        } else {
            return null;
        }        
    }
    return new Domanda($row);
}
?>