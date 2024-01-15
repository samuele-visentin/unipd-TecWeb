<?php

class Recensione {
    public string $id;
    public string $contenuto;
    public DateTime $data_iniziale;
    public ?DateTime $data_Modifica;
    public string $id_utente;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
        $this->contenuto = $row["contenuto"];
        $this->data_iniziale = new DateTime($row["dataIniziale"]);
        if($row["dataModifica"] !== null)
            $this->data_Modifica = new DateTime($row["dataModifica"]);
        else
            $this->data_Modifica = null;
        $this->id_utente = $row["idUtente"];
    }
}

function getAllRecensione() {
    global $DB;
    $result = $DB->query("SELECT * FROM recensione order by dataIniziale asc");
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