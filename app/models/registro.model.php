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
        
        $registro = $query->fetch(PDO::FETCH_OBJ);
        
        return $registro;
    }

    public function insertRegistro($title, $description, $priority, $finished = false) { 
        $query = $this->db->prepare('INSERT INTO registros(titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, $finished]);
        
        $id = $this->db->lastInsertId();
        
        return $id;
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
}
