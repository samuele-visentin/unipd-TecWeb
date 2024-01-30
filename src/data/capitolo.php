<?php
class Capitolo {
    public string $id;
    public string $id_indagine;
    public string $titolo;
    public string $descrizione;
    public int $progressivo;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
        $this->id_indagine = $row["idIndagine"];
        $this->titolo = $row["titolo"];
        $this->descrizione = $row["descrizione"];
        $this->progressivo = $row["progressivo"];
    }
}

function getAllCapitolo() {
    global $DB;
    $result = $DB->query("SELECT * FROM capitolo order by progressivo asc");
    while ($row = $result->fetch_assoc()) {
        $capitoli[] = new Capitolo($row);
    }
    return $capitoli;
}

function getCapitoloById(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM capitolo WHERE id = ?", 
        array("s", $id));
    $row = $result->fetch_assoc();
    return new Capitolo($row);
}

function getCapitoliByIndagine(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM capitolo WHERE idIndagine = ? 
        order by progressivo asc", 
        array("s", $id));
    while ($row = $result->fetch_assoc()) {
        $capitoli[] = new Capitolo($row);
    }
    return $capitoli;
}

function getCapitoloByIndagineAndProgressivo(string $idIndagine, int $progressivoCapitolo) {
    global $DB;
    $result = $DB->query("SELECT * FROM capitolo WHERE idIndagine = ? AND progressivo = ?", 
        array("si", $idIndagine, $progressivoCapitolo));
    $row = $result->fetch_assoc();
    return !is_null($row) ? new Capitolo($row) : null;
}

function getLastCapitoloByDomanda(string $idDomanda) {
    global $DB;
    $result = $DB->query("SELECT progressivo FROM capitolo WHERE id = (SELECT idCapitolo FROM domanda WHERE id = ?)", 
        array("s", $idDomanda));
    $val = $result->fetch_assoc();
    return $val;
}

function getLastCapitoloByUtenteAndIndagine(int $idUtente, string $idIndagine) {
    global $DB;
    $result = $DB->query("SELECT progressivo FROM capitolo WHERE id = (SELECT idCapitolo FROM domanda WHERE id = (SELECT idDomanda FROM salvataggio WHERE idUtente = ? AND idIndagine = ?))", 
        array("is", $idUtente, $idIndagine));
    $val = $result->fetch_assoc();
    return !is_null($val) ? $val["progressivo"] : null;
}

function getCapitoloByDomanda(string $idDomanda) {
    global $DB;
    $result = $DB->query("SELECT * FROM capitolo WHERE id = (SELECT idCapitolo FROM domanda WHERE id = ?)", 
        array("s", $idDomanda));
    $val = $result->fetch_assoc();
    return !is_null($val) ? new Capitolo($val) : null;
}

function getNextCapitoloByIdIndagineAndProgressivo(string $idIndagine, int $progressivoCapitolo) {
    global $DB;
    $result = $DB->query("SELECT * FROM capitolo WHERE idIndagine = ? AND progressivo = ?", 
        array("si", $idIndagine, $progressivoCapitolo + 1));
    $row = $result->fetch_assoc();
    return !is_null($row) ? new Capitolo($row) : null;
}

function getFinalCapitolo(string $idIndagine) {
    global $DB;
    $result = $DB->query("SELECT progressivo FROM capitolo WHERE idindagine = ? ORDER BY progressivo DESC LIMIT 1", 
        array("i", $idIndagine));
    $val = $result->fetch_assoc();
    return !is_null($val) ? $val["progressivo"] : null;
}

?>