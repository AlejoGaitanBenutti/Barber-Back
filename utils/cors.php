<?php
$allowedOrigins = [
    "https://barber-front-mu.vercel.app",
    "http://localhost:5173"
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Vary: Origin"); // para evitar problemas con cache en navegadores
}

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie, Set-Cookie");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}
