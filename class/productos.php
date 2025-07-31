<?php
include __DIR__ . "/conexion.php";


class Productos{

    private $conn;

    private $id;
    private $nombre;
    private $subtitulo;
    private $precio;
    private $caracteristicas;
    private $imagen_principal;
    private $imagen_secundaria_1;
    private $imagen_secundaria_2;
    private $imagen_secundaria_3;
    private $info_adicional;
    private $acerca;


    public function __construct($conexion)
    {

    $this->conn = $conexion;
        
    }



    public function listarTodos(){

        $query = "SELECT * FROM productos"; 

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
        

    }
}