<?php

class RegistroModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
    }
    public function getRegistros() {
        $query = $this->db->prepare(
            'SELECT r.*, e.nombre AS nombre_establecimiento
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

    public function updateRegistro($id, $nombre, $action, $fecha, $hora, $establecimiento_id) {
    $query = $this->db->prepare('UPDATE registros SET nombre = ?, action = ?, fecha = ?, hora = ?, establecimiento_id = ? WHERE id = ?');
    if ($query->execute([$nombre, $action, $fecha, $hora, $establecimiento_id, $id])) {
        return true; // O cualquier otra lógica que necesites
    } else {
        // Manejo de errores
        $errorInfo = $query->errorInfo();
        echo "Error en la consulta: " . $errorInfo[2];
        return false;
    }
}

    public function getRegistrosByEstablecimientoId($id) {
        $query = $this->db->prepare('SELECT * FROM registros WHERE establecimiento_id = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function getRegistroById($id) {
        // Prepara la consulta SQL
        $query = $this->db->prepare('SELECT * FROM registros WHERE id = ?');
        $query->execute([$id]);

        // Retorna el registro si existe, o `false` si no se encuentra
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
