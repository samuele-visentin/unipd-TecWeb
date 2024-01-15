
<?php
require_once("../app/global.php");
require_once("../app/database.php");

enum TipoProva {
    const evento = "evento";
    const testimonianza = "testimonianza";
    const indizio = "indizio";
}

class Prova {
    public string $id;
    public TipoProva $tipo;
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
    $result = $DB->query("SELECT * FROM prova WHERE id = ?", array(array("s", $id)));
    $row = $result->fetch_assoc();
    return new Prova($row);
}
?>