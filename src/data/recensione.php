<?php

class Recensione {
    public string $id;
    public string $contenuto;
    public DateTime $data;
    public string $id_utente;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
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