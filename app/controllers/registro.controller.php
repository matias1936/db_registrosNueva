<?php
require_once './app/models/registro.model.php';
require_once './app/models/establecimiento.model.php';
require_once './app/views/establecimiento.view.php';
require_once './app/views/registro.view.php';


class RegistroController {
    private $model;
    private $establecimientomodel;
    private $view;

    public function __construct($res) {
        $this->model = new RegistroModel();
        $this->establecimientomodel = new EstablecimientoModel();
        $this->view = new RegistroView($res->user);
    }

    public function showRegistros() {
        // obtengo las registros de la DB
        $Registros = $this->model->getRegistros();
        $establecimientos=$this->establecimientomodel->getEstablecimientos();

        // mando las registros a la vista
        return $this->view->showRegistros($Registros,$establecimientos);
    }

    public function addRegistro() {
        // Verificar que todos los campos necesarios estén presentes
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['accion']) || empty($_POST['accion'])) {
            return $this->view->showError('Falta seleccionar la acción');
        }
        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showError('Falta completar la fecha');
        }
        if (!isset($_POST['hora']) || empty($_POST['hora'])) {
            return $this->view->showError('Falta completar la hora');
        }
        if (!isset($_POST['establecimiento_id']) || empty($_POST['establecimiento_id'])) {
            return $this->view->showError('Falta seleccionar el establecimiento');
        }
        echo "Acción seleccionada: " . $_POST['accion']; // Verifica que esto muestre "entrada" o "salida"
        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $accion = $_POST['accion'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $establecimiento_id = $_POST['establecimiento_id'];
    
        // Insertar el nuevo registro en la base de datos
        $id = $this->model->insertRegistro($nombre, $accion, $fecha, $hora, $establecimiento_id);
    
        // Redirigir al home o mostrar un mensaje de éxito
        header('Location: ' . BASE_URL);
    }
    

    
    public function deleteRegistro($id) {
        // obtengo la registro por id
        $registro = $this->model->getRegistro($id);

        if (!$registro) {
            return $this->view->showError("No existe la registro con el id=$id");
        }

        // borro la registro y redirijo
        $this->model->eraseRegistro($id);

        header('Location: ' . BASE_URL);
    }

    public function finishRegistro($id) {
        $registro = $this->model->getRegistro($id);

        if (!$registro) {
            return $this->view->showError("No existe la registro con el id=$id");
        }

        // actualiza la registro
        $this->model->updateRegistro($id);

        header('Location: ' . BASE_URL);
    }
    public function buscar() {
        $establecimiento = $_GET['establecimiento'] ?? null;
        
        // Llama al modelo para obtener los registros filtrados
        $registros = $this->model->getRegistrosByEstablecimiento($establecimiento);
        
        // Muestra la vista con los registros filtrados
        $this->view->showRegistros($registros,$establecimiento);
    }
    public function buscarRegistros() {
        // Verifica si se ha enviado un establecimiento para filtrar
        $establecimiento = $_GET['establecimiento'] ?? null;

        // Verifica si hay un establecimiento y llama al modelo
        if ($establecimiento) {
            $registros = $this->model->getRegistrosByEstablecimiento($establecimiento);
        } else {
            $registros = []; // Manejo si no hay establecimiento
        }

        // Obtiene la lista de establecimientos
        $establecimientos = $this->establecimientomodel->getEstablecimientos();

        // Llama a la vista para mostrar los registros y los establecimientos
        $this->view->showRegistros($registros, $establecimientos);
    }
    
}

