<?php

class Utente {
    public int $id;
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

function getUtenteById(int $id): ?Utente {
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

function login(string $username, string $password): ?Utente {
    global $DB;
    $result = $DB->query("SELECT * FROM utente WHERE username = ? 
        AND passwordHash = ?", array("ss", $username,
        //eseguimo l'hash della password prima del confronto con il db
        hash('sha256', $password)));
    $row = $result->fetch_assoc();
    if($row === null)
        return null;
    return new Utente($row);
}

function insertUtente($username, $password) {
    global $DB;
    $result = $DB->lock_query("INSERT INTO utente (username, passwordHash) 
        VALUES (?, ?)", "utente", array("ss", $username, 
        hash('sha256',$password)));
    return $result;
}

function updatePassowrd(int $idUtente, string $password) {
    global $DB;
    $result = $DB->lock_query("UPDATE utente SET passwordHash = ? WHERE id = ?", 
        "utente", array("ss", hash('sha256',$password), $idUtente));
    return $result;
}

function updateUsername(int $idUtente, string $username) {
    global $DB;
    $result = $DB->lock_query("UPDATE utente SET username = ? WHERE id = ?", 
        "utente", array("si", $username, $idUtente));
    return $result;
}