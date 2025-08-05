<?php

$allowedOrigins = [
    "https://barber-front-s4n3.vercel.app",  
    "https://barber-front-mu.vercel.app",   
    "http://localhost:5173"                   // local dev
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header("Vary: Origin");  // ayuda con cache
} else {
    // No permitir peticiones desde otros orígenes
    header("HTTP/1.1 403 Forbidden");
    exit("Forbidden origin");
}

// Métodos permitidos y headers permitidos
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie, Set-Cookie");

// Responder a la petición OPTIONS (preflight) con status 200 y terminar el script
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
