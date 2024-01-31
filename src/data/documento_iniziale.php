<?php
enum TipoDocumento {
    const lettera = "lettera";
    const cronologia = "cronologia";
}

class DocumentoIniziale {
    public string $id_indagine;
    public $tipo;
    public string $contenuto;
    public int $progressivo;

    public function __construct(array $row) 
    {
        $this->progressivo = $row["progressivo"];
        $this->contenuto = $row["contenuto"];
        $this->id_indagine = $row["idIndagine"];
        switch($row["tipo"]) {
            case "lettera":
                $this->tipo = TipoDocumento::lettera;
                break;
            case "cronologia":
                $this->tipo = TipoDocumento::cronologia;
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

function getDocumentiInizialeByIndagine(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM documentoiniziale WHERE idIndagine = ? 
        order by progressivo asc", 
        array("s", $id));
    while ($row = $result->fetch_assoc()) {
        $documenti[] = new DocumentoIniziale($row);
    }
    return $documenti;
}
?>