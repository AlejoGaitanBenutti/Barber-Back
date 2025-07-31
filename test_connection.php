<?php
$host = getenv("DB_HOST_PROD");
$db = getenv("DB_NAME_PROD");
$user = getenv("DB_USER_PROD");
$pass = getenv("DB_PASS_PROD");

$options = [
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/certs/singlestore_bundle.pem",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, $options);
    echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
