<?php

class RegistroModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
    }
    public function getRegistros() {
        $query = $this->db->prepare('SELECT r.*, e.nombre AS nombre_establecimiento FROM registros r LEFT JOIN establecimientos e ON r.establecimiento_id = e.id');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
 
    public function getRegistro($id) {    
        $query = $this->db->prepare('SELECT * FROM registros WHERE id = ?');
        $query->execute([$id]);   
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Actualizamos la función insertRegistro para usar los campos correctos
    public function insertRegistro($nombre, $action, $fecha, $hora, $establecimiento_id) { 
        $query = $this->db->prepare('INSERT INTO registros(nombre, action, fecha, hora, establecimiento_id) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $action, $fecha, $hora, $establecimiento_id]);
        return $this->db->lastInsertId();
    }
    
 
    public function borrarRegistro($id) {
        $query = $this->db->prepare('DELETE FROM registros WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateRegistro($id, $nombre, $action, $fecha, $hora, $establecimiento_id) {
        $query = $this->db->prepare('UPDATE registros SET nombre = ?, action = ?, fecha = ?, hora = ?, establecimiento_id = ? WHERE id = ?'); 
        $query->execute([$nombre, $action, $fecha, $hora, $establecimiento_id, $id]);
          
    }

    public function getRegistrosByEstablecimientoId($id) {
        $query = $this->db->prepare('SELECT * FROM registros WHERE establecimiento_id = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function getRegistroById($id) {
        $query = $this->db->prepare('SELECT * FROM registros WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
