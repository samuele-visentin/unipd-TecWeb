
<?php
require_once("../app/global.php");
require_once("../app/database.php");

class ProvaDimostra {
    public string $id_prova;
    public string $id_domanda;

    public function __construct(array $row) 
    {
        $this->id_prova = $row["idProva"];
        $this->id_domanda = $row["idDomanda"];
    }
}

function getAllProvaDimostra() {
    global $DB;
    $result = $DB->query("SELECT * FROM provadimostra");
    while ($row = $result->fetch_assoc()) {
        $prove[] = new ProvaDimostra($row);
    }
    return $prove;
}

function getProvaDimostraByIdDomanda(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM provadimostra WHERE idDomanda = ?", array(array("s", $id)));
    $row = $result->fetch_assoc();
    return new ProvaDimostra($row);
}

?>