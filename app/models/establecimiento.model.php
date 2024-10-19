<?php

class EstablecimientoModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
    }

    public function getEstablecimientos() {
        $query = $this->db->prepare('SELECT * FROM establecimientos');
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function addEstablecimiento($nombre, $ciudad, $direccion, $imagen) {
        // Aquí iría la lógica para insertar en la base de datos
        $stmt = $this->db->prepare("INSERT INTO establecimientos (nombre, ciudad, direccion, imagen) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $ciudad, $direccion, $imagen]);
    }
    
}
