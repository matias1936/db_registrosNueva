<?php
require_once './app/models/registro.model.php';
require_once './app/views/establecimiento.view.php';
require_once './libs/Smarty.class.php'; 
require_once './app/models/establecimiento.model.php';

use Smarty\Smarty;

class EstablecimientoController {
    private $model;
    private $view;
    private $smarty;

    public function __construct($res) {
        $this->model = new EstablecimientoModel();
        $this->smarty = new Smarty(); // Crea la instancia de Smarty aquí
        $this->view = new EstablecimientoView($this->smarty); // Pasa la instancia de Smarty al view
    }

    public function showEstablecimientos() {
        $establecimientos = $this->model->getEstablecimientos();
        return $this->view->showEstablecimientos($establecimientos);
    }

    public function addEstablecimiento() {
        // Verificar que todos los campos necesarios estén presentes
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['ciudad']) || empty($_POST['ciudad'])) {
            return $this->view->showError('Falta completar la ciudad');
        }
        if (!isset($_POST['direccion']) || empty($_POST['direccion'])) {
            return $this->view->showError('Falta completar la dirección');
        }
        
        // Verificar si se ha subido una imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTemp = $_FILES['imagen']['tmp_name'];
            $fileType = $_FILES['imagen']['type'];
            
            // Validar el tipo de archivo
            if ($fileType == "image/jpg" || $fileType == "image/jpeg" || $fileType == "image/png") {
                // Define la ruta donde se guardará la imagen
                $filepath = 'ruta/a/tu/carpeta/imagenes/' . basename($_FILES['imagen']['name']);
                
                // Mover el archivo a la ruta especificada
                if (move_uploaded_file($fileTemp, $filepath)) {
                    // Guardar el establecimiento en la base de datos
                    $nombre = $_POST['nombre'];
                    $ciudad = $_POST['ciudad'];
                    $direccion = $_POST['direccion'];
                    
                    // Inserta el nuevo establecimiento en la base de datos
                    $this->model->addEstablecimiento($nombre, $ciudad, $direccion, $filepath);
                    
                    // Redirigir al home o mostrar un mensaje de éxito
                    header('Location: ' . BASE_URL);
                } else {
                    return $this->view->showError('Error al mover el archivo de imagen');
                }
            } else {
                return $this->view->showError('El tipo de archivo de imagen no es válido');
            }
        } else {
            return $this->view->showError('Error al subir la imagen');
        }
    }
    
}
