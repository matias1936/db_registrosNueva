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
}
