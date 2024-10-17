
<?php
require_once './app/models/registro.model.php';
require_once './app/views/establecimiento.view.php';

class EstablecimientoController{
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new RegistroModel();
        $this->view = new EstablecimientoView();
    }
    public function showEstablecimientos() {
        $establecimientos=$this->model->getEstablecimientos();
        return $this->view->showEstablecimientos($establecimientos);
    }
}