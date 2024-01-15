
<?php
require_once("../app/global.php");
require_once("../app/database.php");

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
    $result = $DB->query("SELECT * FROM capitolo WHERE id = ?", array(array("s", $id)));
    $row = $result->fetch_assoc();
    return new Capitolo($row);
}
?>