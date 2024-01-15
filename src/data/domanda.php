
<?php
require_once("../app/global.php");
require_once("../app/database.php");

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

function getDomandaById(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM domanda WHERE id = ?", 
        array("s", $id));
    $row = $result->fetch_assoc();
    return new Domanda($row);
}
?>