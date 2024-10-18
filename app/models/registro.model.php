<?php

class RegistroModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
    }
<<<<<<< HEAD

=======
 
>>>>>>> 5d9b3b27a2875fd6fc5d07c005a00a59827b91a3
    public function getRegistros() {
        $query = $this->db->prepare(
            'SELECT r.*, e.nombre AS establecimiento_nombre
             FROM registros r
             LEFT JOIN establecimientos e ON r.establecimiento_id = e.id'
        );
        $query->execute();
<<<<<<< HEAD
        
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

=======
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
             VALUES (?, ?, ?, ?, ?)'
        );
        $query->execute([$nombre, $action, $fecha, $hora, $establecimiento_id]);
    
        // Retornar el ID del registro recién creado
        return $this->db->lastInsertId();
    }
    
 
>>>>>>> 5d9b3b27a2875fd6fc5d07c005a00a59827b91a3
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
<<<<<<< HEAD
=======
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEstablecimientos() {
        $query = $this->db->prepare('SELECT * FROM establecimientos');
        $query->execute();
>>>>>>> 5d9b3b27a2875fd6fc5d07c005a00a59827b91a3
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
