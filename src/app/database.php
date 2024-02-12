<?php
class DatabaseAccess {
    private const HOST_DB = "localhost";
    private const DATABASE_NAME = "svisenti";
    private const USERNAME = "root";
    private const PASSWORD = ""; 

    private $connection;

    private function connect() {
        $this->connection = new mysqli(self::HOST_DB, self::USERNAME, self::PASSWORD, self::DATABASE_NAME);
        if ($this->connection->error) {
            throw new Exception("Error while connecting to db: ".$this->connection->error);
        }
    }

    private function closeConnection(){
        $this->connection->close();
        $this->connection = null;
    }

    public function query(string $query, array $params = array(),
                        bool $close_connection = true) {
        if($this->connection === null)
            $this->connect();
        $stmt = $this->connection->prepare($query);
        if ($stmt == false) {
            throw new Exception("Connot prepare the query: ". $this->connection->error);
        }
        if(!empty($params)) {
            $format = (string)$params[0];
            $values = array_slice($params, 1);
            $stmt->bind_param($format, ...$values);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if(isset($stmt->error) && $stmt->error !== "") {
            throw new Exception("Error in query: ". $stmt->error);
        }
        $stmt->close();
        if($close_connection) 
            $this->closeConnection();
        return $result;
    }

    public function lock_query(string $query, string $nome_tabella, array $params = array()) {
        $this->connect();
        $res = $this->connection->query("LOCK TABLES " . $nome_tabella . " WRITE");
        if($res === false) {
            throw new Exception("Error while LOCK: ". $this->connection->error);
        }
        try {
            $result = $this->query($query, $params, false);
        } finally {
            $res = $this->connection->query("UNLOCK TABLES");
            if($res === false) {
                throw new Exception("Error while UNLOCK: ". $this->connection->error);
            }
            $this->closeConnection();
        }
        return $result;
    }
}
?>