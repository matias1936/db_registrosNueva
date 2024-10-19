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
        $this->smarty = new Smarty(); // Create the Smarty instance here
        $this->model = new EstablecimientoModel();
        $this->registroModel = new RegistroModel();
        $this->view = new EstablecimientoView($res->user); // Pass the Smarty instance to the view
        $this->registroView = new RegistroView($res->user);
    }

    public function showEstablecimientos() {
        $establecimientos = $this->model->getEstablecimientos();
        return $this->view->showEstablecimientos($establecimientos);
    }

    public function verRegistroEstablecimiento($id) {
        // Obtener los registros filtrados por el ID del establecimiento
        $registros = $this->registroModel->getRegistrosByEstablecimientoId($id);
        
        // Obtener los establecimientos (si es necesario, asegúrate de que esta variable esté disponible)
        $establecimientos = $this->model->getEstablecimientos(); // Asegúrate de que esta función exista
    
        // Llamar a la función showRegistros en la vista
        return $this->registroView->showRegistros($registros, $establecimientos);
    }

    public function addEstablecimiento() {
        // Validate required fields
        if (empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (empty($_POST['ciudad'])) {
            return $this->view->showError('Falta completar la ciudad');
        }
        if (empty($_POST['direccion'])) {
            return $this->view->showError('Falta completar la dirección');
        }
        
        // Check if an image has been uploaded
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTemp = $_FILES['imagen']['tmp_name'];
            $fileType = $_FILES['imagen']['type'];
            
            // Validate the file type
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if (in_array($fileType, $allowedTypes)) {
                // Define the path where the image will be saved
                $filepath = 'app/images/' . basename($_FILES['imagen']['name']);
                
                // Move the file using the model's function
                if ($this->model->moveImage($fileTemp, $filepath)) {
                    // Save the establishment in the database
                    $nombre = $_POST['nombre'];
                    $ciudad = $_POST['ciudad'];
                    $direccion = $_POST['direccion'];
                    
                    // Insert the new establishment into the database
                    $this->model->addEstablecimiento($nombre, $ciudad, $direccion, $filepath);
                    
                    // Redirect to the home or show a success message
                    header('Location: ' . BASE_URL . '?action=listar_establecimientos');
                    exit; // Ensure to exit after redirection
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
        // Check if an ID has been passed via POST
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            
            // Get the establishment by ID
            $establecimiento = $this->model->getEstablecimientoById($id);
    
            if (!$establecimiento) {
                return $this->view->showError("No existe el establecimiento con el id=$id");
            }
    
            // Delete the establishment and redirect
            $this->model->deleteEstablecimiento($id);
    
            header('Location: ' . BASE_URL . '?action=listar_establecimientos');
            exit;
        } else {
            return $this->view->showError("No se recibió un ID válido para eliminar el establecimiento.");
        }
    }
}