<?php
require_once(__DIR__."/salvataggio.php");

enum TipoProva {
    const evento = "evento";
    const testimonianza = "testimonianza";
    const indizio = "indizio";
}

class Prova {
    public string $id;
    public $tipo;
    public string $id_indagine;
    public string $id_capitolo;
    public string $contenuto;
    public ?string $image_path;
    public string $titolo;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
        $this->id_indagine = $row["idIndagine"];
        $this->titolo = $row["titolo"];
        $this->id_capitolo = $row["idCapitolo"];
        $this->contenuto = $row["contenuto"];
        $this->image_path = $row["image_path"];
        switch($row["tipo"]) {
            case "evento":
                $this->tipo = TipoProva::evento;
                break;
            case "testimonianza":
                $this->tipo = TipoProva::testimonianza;
                break;
            case "indizio":
                $this->tipo = TipoProva::indizio;
                break;
        }
    }
}

function getAllProva() {
    global $DB;
    $result = $DB->query("SELECT * FROM prova order by id asc");
    while ($row = $result->fetch_assoc()) {
        $prove[] = new Prova($row);
    }
    return $prove;
}

function getProvaById(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM prova WHERE id = ?", 
        array("s", $id));
    $row = $result->fetch_assoc();
    return new Prova($row);
}

function getProvaByIdIndagine(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM prova WHERE idIndagine = ?", 
        array("s", $id));
    while ($row = $result->fetch_assoc()) {
        $prove[] = new Prova($row);
    }
    return $prove;
}

function getProveByIndagineAndProgressivoCapitolo(string $idIndagine, int $progressivoCapitolo) {
    global $DB;
    $result = $DB->query("SELECT * FROM prova WHERE idCapitolo = 
        (SELECT id FROM capitolo WHERE idIndagine = ? AND progressivo = ?);", 
        array("si", $idIndagine, $progressivoCapitolo));
    $prove = array();
    while ($row = $result->fetch_assoc()) {
        $prove[] = new Prova($row);
    }
    return (!empty($prove)) ? $prove : null;
}

function getProveBySalvataggio(Salvataggio $salvataggio) {
    $query = "SELECT prova.id as id, prova.idIndagine as idIndagine, 
        prova.titolo as titolo, 
        prova.idCapitolo as idCapitolo, prova.contenuto as contenuto, 
        prova.image_path as image_path, prova.tipo as tipo
        FROM domanda 
        JOIN capitolo ON domanda.idCapitolo = capitolo.id and domanda.id = ?
        JOIN prova ON capitolo.id = prova.idCapitolo";
    global $DB;
    $result = $DB->query($query, array("s", $salvataggio->id_domanda));
    while ($row = $result->fetch_assoc()) {
        $prove[] = new Prova($row);
    }
    return $prove;
}
?>