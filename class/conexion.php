<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Database {
    private $conn;

    public function getConnection() {
        // Detectar entorno usando $_ENV porque getenv() puede fallar
        $env = $_ENV["APP_ENV"] ?? false;

        // Si estamos en local, cargamos el archivo .env
        if ($env === false || $env === "local") {
            $dotenvPath = __DIR__ . "/..";
            $dotenv = Dotenv::createImmutable($dotenvPath);
            $dotenv->load();
            // Recargamos $_ENV para asegurar que se actualice después de load()
            $env = $_ENV["APP_ENV"] ?? false;
        }

        // Determinar si es producción
        $isProd = ($env === "production");

        // Leer variables de entorno desde $_ENV
        $host = $isProd ? ($_ENV["DB_HOST_PROD"] ?? null) : ($_ENV["DB_HOST"] ?? null);
        $port = $isProd ? ($_ENV["DB_PORT_PROD"] ?? null) : ($_ENV["DB_PORT"] ?? null);
        $db_name = $isProd ? ($_ENV["DB_NAME_PROD"] ?? null) : ($_ENV["DB_NAME"] ?? null);
        $username = $isProd ? ($_ENV["DB_USER_PROD"] ?? null) : ($_ENV["DB_USER"] ?? null);
        $password = $isProd ? ($_ENV["DB_PASS_PROD"] ?? null) : ($_ENV["DB_PASS"] ?? null);

        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            if ($isProd) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = __DIR__ . '/../certs/singlestore_bundle.pem';
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
            }

            $this->conn = new PDO(
                "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8",
                $username,
                $password,
                $options
            );

        } catch (PDOException $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
            exit;
        }

        return $this->conn;
    }
}
