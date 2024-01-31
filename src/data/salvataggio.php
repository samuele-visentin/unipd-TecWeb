<?php

class Salvataggio {
    public string $id_indagine;
    public string $id_utente;
    public string $id_domanda;

    public function __construct(array $row) 
    {
        $this->id_indagine = $row["idIndagine"];
        $this->id_utente = $row["idUtente"];
        $this->id_domanda = $row["idDomanda"];
    }
}

function getAllSalvataggio() {
    global $DB;
    $result = $DB->query("SELECT * FROM salvataggio");
    while ($row = $result->fetch_assoc()) {
        $salvataggi[] = new Salvataggio($row);
    }
    return $salvataggi;
}

function getSalvataggiByIdUtente(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM salvataggio WHERE idUtente = ?", 
        array("s", $id));
    while ($row = $result->fetch_assoc()) {
        $salvataggi[] = new Salvataggio($row);
    }
    return $salvataggi;
}

function getSalvataggioByUtenteAndIndagine(int $idUtente, string $idIndagine) {
    global $DB;
    $result = $DB->query("SELECT * FROM salvataggio WHERE idUtente = ? AND idIndagine = ?", 
        array("is", $idUtente, $idIndagine));
    $row = $result->fetch_assoc();
    return (!is_null($row)) ? new Salvataggio($row) : null;
}

function getSalvataggioByUtenteAndIdDomanda(int $idUtente, string $idDomanda) {
    global $DB;
    $result = $DB->query("SELECT * FROM salvataggio WHERE idUtente = ? AND idDomanda <= ?", 
        array("is", $idUtente, $idDomanda));
    $row = $result->fetch_assoc();
    return (!is_null($row)) ? new Salvataggio($row) : null;
}

function insertSalvataggio($idUtente, $indagine, $domanda) {
    global $DB;
    $result = $DB->lock_query("INSERT INTO salvataggio (idIndagine, idUtente, idDomanda) 
        VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE idDomanda=?", "salvataggio", array("siss", $indagine, $idUtente, $domanda->id, $domanda->id));
    return $result;
}

function destroySalvataggio($idUtente, $indagine) {
    global $DB;
    $result = $DB->lock_query("UPDATE `salvataggio` SET `idDomanda` = NULL WHERE `salvataggio`.`idIndagine` = ? AND `salvataggio`.`idUtente` = ?", "salvataggio", array("si", $indagine, $idUtente));
    return $result;
}

function isFinished($idUtente, $indagine) {
    global $DB;
    $result = $DB->query("SELECT * FROM salvataggio WHERE idUtente = ? AND idIndagine = ? AND idDomanda IS NULL", 
        array("is", $idUtente, $indagine));
    $row = $result->fetch_assoc();
    return !is_null($row);
}