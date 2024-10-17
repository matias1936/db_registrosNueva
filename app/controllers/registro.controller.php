<?php
require_once './app/models/registro.model.php';
require_once './app/views/registro.view.php';

class RegistroController {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new RegistroModel();
        $this->view = new RegistroView($res->user);
    }

    public function showRegistros() {
        // obtengo las registros de la DB
        $Registros = $this->model->getRegistros();
        $establecimientos=$this->model->getEstablecimientos();

        // mando las registros a la vista
        return $this->view->showRegistros($Registros,$establecimientos);
    }

    public function addRegistro() {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta completar el título');
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            return $this->view->showError('Falta completar la prioridad');
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertRegistro($title, $description, $priority);
    
        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
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
        $this->view->showRegistros($registros,$establecimientos);
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
        $establecimientos = $this->model->getEstablecimientos();

        // Llama a la vista para mostrar los registros y los establecimientos
        $this->view->showRegistros($registros, $establecimientos);
    }
    
}

