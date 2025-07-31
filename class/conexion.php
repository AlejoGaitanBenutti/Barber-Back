<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Database {
    private $conn;

    public function getConnection() {
        // Cargar archivo .env
        $dotenv = Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();

        // Detectar entorno
        $isProd = getenv("APP_ENV") === "production";

        // Seleccionar variables
        $host = $isProd ? getenv("DB_HOST_PROD") : getenv("DB_HOST");
        $port = $isProd ? getenv("DB_PORT_PROD") : getenv("DB_PORT");
        $db_name = $isProd ? getenv("DB_NAME_PROD") : getenv("DB_NAME");
        $username = $isProd ? getenv("DB_USER_PROD") : getenv("DB_USER");
        $password = $isProd ? getenv("DB_PASS_PROD") : getenv("DB_PASS");

        try {
            $this->conn = new PDO(
                "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8",
                $username,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conn;
    }
}
