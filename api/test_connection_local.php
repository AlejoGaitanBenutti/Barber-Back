<?php
$host = getenv("DB_HOST") ?: 'localhost';
$port = getenv("DB_PORT") ?: 3308; // usa 3308 por defecto
$db = getenv("DB_NAME") ?: 'barber';
$user = getenv("DB_USER") ?: 'root';
$pass = getenv("DB_PASS") ?: '';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "✅ Conexión exitosa al MySQL local";
} catch (PDOException $e) {
    echo "❌ Error de conexión local: " . $e->getMessage();
}
