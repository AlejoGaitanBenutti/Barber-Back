<?php

class Database {
    private $host = "localhost";
    private $db_name = "barber";
    private $username = "root";
    private $password = "";
    private $port = "3308";
    private $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // ⚠️ Mostramos el error para debugging
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conn;
    }
}
