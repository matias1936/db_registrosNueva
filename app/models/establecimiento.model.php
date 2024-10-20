<?php
class EstablecimientoModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=db_registros;charset=utf8', 'root', '');
        } 
        catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getEstablecimientos() {
        $query = $this->db->prepare('SELECT * FROM establecimientos');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getEstablecimientoById($id) {
        $query = $this->db->prepare('SELECT * FROM establecimientos WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function addEstablecimiento($nombre, $ciudad, $direccion, $imagen) {
        $query = $this->db->prepare("INSERT INTO establecimientos (nombre, ciudad, direccion, imagen) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $ciudad, $direccion, $imagen]);
    }

    public function updateEstablecimiento($nombre, $ciudad, $direccion, $imagen, $id) {
        $query = $this->db->prepare("UPDATE establecimientos SET nombre = ?, ciudad = ?, direccion = ?, imagen = ? WHERE id = ?");
        $query->execute([$nombre, $ciudad, $direccion, $imagen, $id]);
    }
    
    public function deleteEstablecimiento($id) {
        $query = $this->db->prepare('DELETE FROM establecimientos WHERE id = ?');
        $query->execute([$id]);
    }

    public function moveImage($fileTemp, $filepath) {
        if (!file_exists(dirname($filepath))) {
            mkdir(dirname($filepath), 0777, true);
        }
        return move_uploaded_file($fileTemp, $filepath);
    }
   
}