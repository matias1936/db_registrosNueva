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
        if (empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (empty($_POST['ciudad'])) {
            return $this->view->showError('Falta completar la ciudad');
        }
        if (empty($_POST['direccion'])) {
            return $this->view->showError('Falta completar la dirección');
        }
        
        // Verificar si se ha subido una imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTemp = $_FILES['imagen']['tmp_name'];
            $fileType = $_FILES['imagen']['type'];
            
            // Validar el tipo de archivo
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if (in_array($fileType, $allowedTypes)) {
                // Define la ruta donde se guardará la imagen
                $filepath = 'app/images/' . basename($_FILES['imagen']['name']);
                
                // Mover el archivo usando la nueva función del modelo
                if ($this->model->moveImage($fileTemp, $filepath)) {
                    // Guardar el establecimiento en la base de datos
                    $nombre = $_POST['nombre'];
                    $ciudad = $_POST['ciudad'];
                    $direccion = $_POST['direccion'];
                    
                    // Inserta el nuevo establecimiento en la base de datos
                    $this->model->addEstablecimiento($nombre, $ciudad, $direccion, $filepath);
                    
                    // Redirigir al home o mostrar un mensaje de éxito
                    header('Location: ' . BASE_URL . '?action=listar_establecimientos');
                    exit; // Asegúrate de salir después de la redirección
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
    public function deleteEstablecimiento() {
        // Verificar que se haya pasado un ID a través de GET o POST
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            
            // Obtener el establecimiento por ID
            $establecimiento = $this->model->getEstablecimientoById($id);
    
            if (!$establecimiento) {
                return $this->view->showError("No existe el establecimiento con el id=$id");
            }
    
            // Borrar el establecimiento y redirigir
            $this->model->deleteEstablecimiento($id);
    
            header('Location: ' . BASE_URL . '?action=listar_establecimientos');
            exit;
        } else {
            return $this->view->showError("No se recibió un ID válido para eliminar el establecimiento.");
        }
    }
    
    
}
