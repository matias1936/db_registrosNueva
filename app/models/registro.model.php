<?php

class RegistroModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
    }
    public function getRegistros() {
        $query = $this->db->prepare(
            'SELECT r.*, e.nombre AS establecimiento_nombre
             FROM registros r
             LEFT JOIN establecimientos e ON r.establecimiento_id = e.id'
        );
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
        // Depuración
        var_dump($nombre, $action, $fecha, $hora, $establecimiento_id); // Agrega esta línea para verificar los datos
    
        $query = $this->db->prepare(
            'INSERT INTO registros(nombre, action, fecha, hora, establecimiento_id) 
             VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $action, $fecha, $hora, $establecimiento_id]);
    
        // Retornar el ID del registro recién creado
        return $this->db->lastInsertId();
    }
    
 
    public function eraseRegistro($id) {
        $query = $this->db->prepare('DELETE FROM registros WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateRegistro($id) {        
        $query = $this->db->prepare('UPDATE registros SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }

    public function getRegistrosByEstablecimiento($establecimiento) {
        $query = $this->db->prepare(
            'SELECT r.*, e.nombre AS establecimiento_nombre
             FROM registros r
             JOIN establecimientos e ON r.establecimiento_id = e.id
             WHERE r.establecimiento_id = ?'
        );
        $query->execute([$establecimiento]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEstablecimientos() {
        $query = $this->db->prepare('SELECT * FROM establecimientos');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
