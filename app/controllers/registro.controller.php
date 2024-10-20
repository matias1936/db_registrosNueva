<?php
require_once './app/models/registro.model.php';
require_once './app/views/registro.view.php';
require_once './app/models/establecimiento.model.php';

class RegistroController {
    private $model;
    private $view;
    private $modelEstablecimiento;

    public function __construct($res) {
        $this->model = new RegistroModel();
        $this->view = new RegistroView($res->user);
        $this->modelEstablecimiento= new EstablecimientoModel();
    }

    public function verDetalleRegistro($id) {
        $registro = $this->model->getRegistro($id);
        
        if ($registro) {

            $establecimiento = $this->modelEstablecimiento->getEstablecimientoById($registro->establecimiento_id);
            $this->view->showDetalleRegistro($registro, $establecimiento);
        } 
        else {
            header('Location: ' . BASE_URL);
        }
    }



    
    public function showRegistros() {
     
        $registros = $this->model->getRegistros();
        $establecimientos=$this->modelEstablecimiento->getEstablecimientos();
        return $this->view->showRegistros($registros,$establecimientos);

    }
    public function showRegistrosByEstablecimiento($id) {

        $registros = $this->model->getRegistros();
        $establecimientos=$this->modelEstablecimiento->getEstablecimientos();
        return $this->view->showRegistros($registros,$establecimientos);
    }

    public function addRegistro() {
        // Verifica que el campo nombre no esté vacío
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        // Verifica que el campo acción no esté vacío
        if (!isset($_POST['accion']) || empty($_POST['accion'])) {
            return $this->view->showError('Falta completar la acción');
        }
        // Verifica que el campo fecha no esté vacío
        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showError('Falta completar la fecha');
        }
        // Verifica que el campo hora no esté vacío
        if (!isset($_POST['hora']) || empty($_POST['hora'])) {
            return $this->view->showError('Falta completar la hora');
        }
        // Verifica que el campo establecimiento_id no esté vacío
        if (!isset($_POST['establecimiento_id']) || empty($_POST['establecimiento_id'])) {
            return $this->view->showError('Falta seleccionar un establecimiento');
        }
        // Agarramos los datos del formulario
        $nombre = $_POST['nombre'];
        $accion = $_POST['accion'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $establecimiento_id = $_POST['establecimiento_id'];

        $this->model->insertRegistro($nombre, $accion, $fecha, $hora, $establecimiento_id);
        header('Location: ' . BASE_URL);
    }
    

    
    public function deleteRegistro($id) {
        
      

        if (!$id) {
            return $this->view->showError("No existe la registro con el id=$id");
        }

        $this->model->borrarRegistro($id);

        header('Location: ' . BASE_URL);
    }

    public function mostrarFormModificar($id) {
        $registro = $this->model->getRegistro($id);
        $establecimientos=$this->modelEstablecimiento->getEstablecimientos();
        $this->view->showModifyRegistroForm($registro,$establecimientos); // Pasar el registro a modificar
    }

    public function updateRegistro($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $action = $_POST['action'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $establecimiento_id = $_POST['establecimiento_id'];
           
            $this->model->updateRegistro($id, $nombre, $action, $fecha, $hora,$establecimiento_id);
    
            header('Location: ' . BASE_URL);
        } else {
            // Redirigir a la lista si no es una solicitud POST
            header('Location: ' . BASE_URL);
        }
    }
    



    public function buscarRegistros() {
        // Verifica si se ha enviado un establecimiento para filtrar
        $establecimientoId = $_GET['establecimiento'] ?? null;
        $establecimientos=$this->modelEstablecimiento->getEstablecimientos();
    
        // Verifica si hay un establecimiento y llama al modelo
        if ($establecimientoId) {
            // Obtener los registros filtrados por el ID del establecimiento
            $registros = $this->model->getRegistrosByEstablecimientoId($establecimientoId);
    
            // Obtener el objeto del establecimiento para más detalles
            $establecimiento = $this->modelEstablecimiento->getEstablecimientoById($establecimientoId);
        } else {
            $registros = []; // Manejo si no hay establecimiento
            $establecimiento = null; // No hay establecimiento
        }
    
        // Llama a la vista para mostrar los registros y los establecimientos
        $this->view->showRegistrosByEstablecimiento($registros, $establecimiento,$establecimientos);
    }

    
    
}

