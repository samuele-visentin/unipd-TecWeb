
<?php
require_once("../app/global.php");
require_once("../app/database.php");

class Salvataggio {
    public string $id_indagine;
    public string $id_utente;
    public string $progressivo_domanda;

    public function __construct(array $row) 
    {
        $this->id_indagine = $row["idIndagine"];
        $this->id_utente = $row["idUtente"];
        $this->progressivo_domanda = $row["progressivoDomanda"];
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
