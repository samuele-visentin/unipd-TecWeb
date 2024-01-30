<?php

class Recensione {
    public string $id_indagine;
    public string $contenuto;
    public DateTime $data;
    public int $id_utente;

    public function __construct(array $row) 
    {
        $this->id_indagine = $row["idIndagine"];
        $this->contenuto = $row["contenuto"];
        $this->data = new DateTime($row["data"]);
        $this->id_utente = $row["idUtente"];
    }
}

function getAllRecensione() {
    global $DB;
    $result = $DB->query("SELECT * FROM recensione order by data asc");
    while ($row = $result->fetch_assoc()) {
        $recensioni[] = new Recensione($row);
    }
    return $recensioni;
}

function getRecensioneByUtente(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM recensione WHERE idUtente = ? 
        order by dataIniziale", array("s", $id));
    while ($row = $result->fetch_assoc()) {
        $recensioni[] = new Recensione($row);
    }
    return $recensioni;
}

function getRecensioniByIndagine(string $idIndagine): ?array{
    global $DB;
    $result = $DB->query("SELECT * FROM recensione WHERE idIndagine = ? 
        order by data desc", array("s", $idIndagine));
    while ($row = $result->fetch_assoc()) {
        $recensioni[] = new Recensione($row);
    }
    return $recensioni ?? null;
}

function getRecensioneByIndagineAndUtente(string $idIndagine, int $idUtente): ?Recensione{
    global $DB;
    $result = $DB->query("SELECT * FROM recensione WHERE idIndagine = ? AND idUtente = ? 
        order by data desc", array("si", $idIndagine, $idUtente));
    $row = $result->fetch_assoc();
    return (!is_null($row)) ? new Recensione($row) : null;
}

function saveRecensione(int $idUtente, string $idIndagine, string $contenuto) {
    global $DB;
    $result = $DB->lock_query("INSERT INTO recensione (idUtente, idIndagine, contenuto, data) 
        VALUES (?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE contenuto = ?, data = NOW()", "recensione", array("isss", $idUtente, $idIndagine, $contenuto, $contenuto));
    return $result;
}

function removeRecensione(int $idUtente, string $idIndagine) {
    global $DB;
    $DB->lock_query("DELETE FROM recensione WHERE idUtente = ? AND idIndagine = ?", "recensione", array("is", $idUtente, $idIndagine));
}