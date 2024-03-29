<?php
class Indagine {
    public string $id;
    public DateTime $data_inserimento;
    public string $nome;
    public string $descrizione;
    public ?string $image_path;

    public function __construct($row) {
        $this->id = $row["id"];
        $this->data_inserimento = new DateTime($row["dataInserimento"]);
        $this->nome = $row["nome"];
        $this->descrizione = $row["descrizione"];
        $this->image_path = $row["image_path"];
    }
}

function getAllIndagine() {
    global $DB;
    $result = $DB->query("SELECT * FROM indagine");
    while ($row = $result->fetch_assoc()) {
        $indagini[] = new Indagine($row);
    }
    return $indagini;
}

function getIndagineById(string $id) {
    global $DB;
    $result = $DB->query("SELECT * FROM indagine WHERE id = ?", 
        array("s", $id));
    $row = $result->fetch_assoc();
    return !is_null($row) ? new Indagine($row) : null;
}

function getLastIndagine() {
    global $DB;
    $result = $DB->query("SELECT * FROM indagine ORDER BY dataInserimento DESC LIMIT 1");
    $row = $result->fetch_assoc();
    return !is_null($row) ? new Indagine($row) : null;
}
?>