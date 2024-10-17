<?php

class RegistroModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
    }
 
    public function getRegistros() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM registros');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $registros = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $registros;
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
}