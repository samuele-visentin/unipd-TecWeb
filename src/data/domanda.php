<?php
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


function getNextDomandaByIdDomanda(string $idDomanda) {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE id = 
    (SELECT id + 1 FROM domanda WHERE id = ?)", 
    array("s", $idDomanda));
    $row = $result->fetch_assoc();
    if ($row === null) {
        // Get the next chapter's question
        $nextChapterProgressivo = $progressivoCapitolo + 1;
        $result = $DB->query("SELECT * FROM domanda WHERE idCapitolo = 
        (SELECT id FROM capitolo WHERE idIndagine = ? AND progressivo = ?);", 
        array("si", $idIndagine, $nextChapterProgressivo));
        $row = $result->fetch_assoc();
    }
    return new Domanda($row);
}
?>