<?php
require_once("../app/database.php");

class Utente {
    public string $id;
    public string $username;
    public string $password_hash;
    public bool $is_admin;

    public function __construct(array $row) 
    {
        $this->id = $row["id"];
        $this->username = $row["username"];
        $this->password_hash = $row["passwordHash"];
        $this->is_admin = (bool)$row["isAdmin"] ?? false;
    }
}

function getAllUtenti() {
    global $DB;
    $result = $DB->query("SELECT * FROM utente");
    while ($row = $result->fetch_assoc()) {
        $utenti[] = new Utente($row);
    }
    return $utenti;
}

function getUtenteById(string $id): ?Utente {
    global $DB;
    $result = $DB->query("SELECT * FROM utente WHERE id = ?", array("s", $id));
    $row = $result->fetch_assoc();
    if($row === null)
        return null;
    return new Utente($row);
}

function getUtenteByUsername(string $username): ?Utente {
    global $DB;
    $result = $DB->query("SELECT * FROM utente WHERE username = ?", 
        array("s", $username));
    $row = $result->fetch_assoc();
    if($row === null)
        return null;
    return new Utente($row);
}

function login(string $username, string $password) {
    global $DB;
    $result = $DB->query("SELECT * FROM utente WHERE username = ? 
        AND passwordHash = ?", array("ss", $username, 
        hash('sha256', $password)));
    $row = $result->fetch_assoc();
    if($row === null)
        return null;
    return new Utente($row);
}

function insertUtente($username, $password) {
    global $DB;
    $result = $DB->lock_query("INSERT INTO utente (username, password_hash) 
        VALUES (?, ?, ?)", "utente", array("ss", $username, 
        hash('sha256',$password)));
    return $result;
}