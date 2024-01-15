
<?php
require_once("../app/global.php");
require_once("../app/database.php");

enum TipoDocumento {
    const Lettera = "lettera";
    const Cronologia = "cronologia";
}

class DocumentoIniziale {
    public string $id_indagine;
    public TipoDocumento $tipo;
    public string $contenuto;
    public int $progressivo;

    public function __construct(array $row) 
    {
        $this->progressivo = $row["progressivo"];
        $this->contenuto = $row["contenuto"];
        $this->id_indagine = $row["idIndagine"];
        switch($row["tipo"]) {
            case "lettera":
                $this->tipo = TipoDocumento::Lettera;
                break;
            case "cronologia":
                $this->tipo = TipoDocumento::Cronologia;
                break;
        }
    }
}

function getAllDocumentoIniziale() {
    global $DB;
    $result = $DB->query("SELECT * FROM documentoiniziale order by progressivo asc");
    while ($row = $result->fetch_assoc()) {
        $documenti[] = new DocumentoIniziale($row);
    }
    return $documenti;
}

function getDocumentoInizialeById(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM documentoiniziale WHERE id = ?", 
        array("s", $id));
    $row = $result->fetch_assoc();
    return new DocumentoIniziale($row);
}
?>