<?php
require_once './app/models/registro.model.php';
require_once './app/models/establecimiento.model.php';
require_once './app/views/establecimiento.view.php';
require_once './app/views/registro.view.php';
require_once './libs/Smarty.class.php'; 

use Smarty\Smarty;

class EstablecimientoController {
    private $model;
    private $registroModel;
    private $view;
    private $registroView;
    private $smarty;

    public function __construct($res) {
        $this->smarty = new Smarty();
        $this->model = new EstablecimientoModel();
        $this->view = new EstablecimientoView($res->user); 
        $this->registroModel = new RegistroModel();
        $this->registroView = new RegistroView($res->user);
    }

    public function showEstablecimientos() {
        $establecimientos = $this->model->getEstablecimientos();
        return $this->view->showEstablecimientos($establecimientos);
    }

    public function verRegistrosEstablecimiento() {
        if (isset($_POST['id'])) { 
            $id = $_POST['id'];
            $registros = $this->registroModel->getRegistrosByEstablecimientoId($id);
            $establecimiento = $this->model->getEstablecimientoById($id); 
            $establecimientos = $this->model->getEstablecimientos();
            
            return $this->registroView->showRegistrosByEstablecimiento($registros, $establecimiento,$establecimientos);
        } 
        else {
            return $this->view->showError("No se recibió un ID válido para un registro.");
        }
    }

    public function deleteEstablecimiento() {
        if (isset($_POST['id'])) {

            $id = $_POST['id'];
            $establecimiento = $this->model->getEstablecimientoById($id);
    
            if (!$establecimiento) {
                return $this->view->showError("No existe el establecimiento con el id=$id");}

            $this->model->deleteEstablecimiento($id);
    
            header('Location: ' . BASE_URL . '?action=listar_establecimientos');
            exit;    
        } 
        else {
            return $this->view->showError("No se recibió un ID válido para eliminar el establecimiento.");
        }
    }

    public function addEstablecimiento() {
        if (empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (empty($_POST['ciudad'])) {
            return $this->view->showError('Falta completar la ciudad');
        }
        if (empty($_POST['direccion'])) {
            return $this->view->showError('Falta completar la dirección');
        }
        
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

            $fileTemp = $_FILES['imagen']['tmp_name'];
            $fileType = $_FILES['imagen']['type'];
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];

            if (in_array($fileType, $allowedTypes)) {

                $filepath = 'app/images/' . basename($_FILES['imagen']['name']);

                if ($this->model->moveImage($fileTemp, $filepath)) {
                    $nombre = $_POST['nombre'];
                    $ciudad = $_POST['ciudad'];
                    $direccion = $_POST['direccion'];
                    $this->model->addEstablecimiento($nombre, $ciudad, $direccion, $filepath);
                    header('Location: ' . BASE_URL . '?action=listar_establecimientos');
                    exit; 
                } 
                else {
                    return $this->view->showError('Error al mover el archivo de imagen');
                }
                
            } 
            else {
                return $this->view->showError('El tipo de archivo de imagen no es válido');
            }

        } 
        else {
            return $this->view->showError('Error al subir la imagen');
        }
    }

    public function updateEstablecimiento($id) {
        if (empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (empty($_POST['ciudad'])) {
            return $this->view->showError('Falta completar la ciudad');
        }
        if (empty($_POST['direccion'])) {
            return $this->view->showError('Falta completar la dirección');
        }
        $nombre = $_POST['nombre'];
        $ciudad = $_POST['ciudad'];
        $direccion = $_POST['direccion'];
    
        // Inicializar la variable para la imagen (por defecto sin cambiar)
        $filepath = null;
    
        // Verificar si se ha subido una nueva imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTemp = $_FILES['imagen']['tmp_name'];
            $fileType = $_FILES['imagen']['type'];
    
            // Validar el tipo de archivo
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if (in_array($fileType, $allowedTypes)) {
                // Definir la ruta donde se guardará la nueva imagen
                $filepath = 'app/images/' . basename($_FILES['imagen']['name']);
    
                // Mover el archivo usando la función del modelo
                if (!$this->model->moveImage($fileTemp, $filepath)) {
                    return $this->view->showError('Error al mover el archivo de imagen');
                }
            } 
            else {
                return $this->view->showError('El tipo de archivo de imagen no es válido');
            }
        } 
        else {
            $filepath = $_POST['imagen_actual'];
        }
    
        // Llamar al modelo para actualizar el establecimiento
        $this->model->updateEstablecimiento($nombre, $ciudad, $direccion, $filepath, $id);
    
        // Redirigir después de la actualización
        header('Location: ' . BASE_URL . '?action=listar_establecimientos');
        exit; // Finalizar la ejecución después de la redirección
    }
    public function mostrarFormModificarEstablecimiento($id) {

        $establecimiento = $this->model->getEstablecimientoById($id);
        $this->view->showModifyEstablecimientoForm($establecimiento);

    }
    
}