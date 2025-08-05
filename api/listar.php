<?php
include __DIR__ . "/../utils/cors.php";
include __DIR__ . "/../class/productos.php";
require_once __DIR__ . '/../class/conexion.php';

header("Content-Type: application/json");

$db = New Database;

$conn = $db->getConnection();


$productos = New Productos($conn);

$listar = $productos->listarTodos();

echo json_encode($listar);

