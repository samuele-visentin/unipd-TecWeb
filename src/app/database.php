<?php
    class DatabaseAccess {
        static private const HOST_DB = "localhost";
        static private const DATABASE_NAME = "tecweb";
        static private const USERNAME = "root";
        static private const PASSWORD = "";

        private $connection;
        private $is_persistent = false;

        private function connection() {
            $this->connection = new mysqli(self::HOST_DB, self::USERNAME, self::PASSWORD, self::DATABASE_NAME);
            if ($this->connection->error) {
                throw new Exception("Error while connecting to db: ".$this->connection->error);
            }
        }

        public function closeConnection(){
            if ($this->is_persistent === false) {
                $this->connection->close();
            }
        }

        public function setPersistentConnection(bool $is_persistent) {
            $this->is_persistent = $is_persistent;
        }

        public function query(string $query, array $params = array()) {
            $this->connection();
            $stmt = $this->connection->prepare($query);
            if ($stmt == false) {
                throw new Exception("Connot prepare the query: ". $this->connection->error);
            }
            $format = "";
            $values = array();
            foreach ($params as $valtype) {
                $format .= $valtype[0];
                $values[] = $valtype[1];
            }
            if ($format !== "") {
                $stmt->bind_param($format, ...$values);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if($result === false) {
                throw new Exception("Error in query: ". $stmt->error);
            }
            $stmt->close();
            $this->closeConnection();
            return $result;
        }
    }
?>