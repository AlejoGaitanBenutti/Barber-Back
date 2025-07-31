<?php
// CORS para permitir accesos desde tu frontend en Vercel
require_once __DIR__ . '/utils/cors.php';

header("Content-Type: application/json");

$response = [
    "api" => "Barber Backend",
    "status" => "✅ Online",
    "endpoints" => [
        "GET /api/listar.php" => "Devuelve todos los productos",
    ],
    "author" => "Alejo",
    "documentacion" => "Próximamente..."
];

echo json_encode($response, JSON_PRETTY_PRINT);
