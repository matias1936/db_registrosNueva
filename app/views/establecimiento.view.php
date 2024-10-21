<?php
require_once './libs/Smarty.class.php';
use Smarty\Smarty;

class EstablecimientoView {
    private $smarty;
    private $user;

    public function __construct($smarty, $user = null) {
        $this->smarty = new Smarty();
        $this->user = $user; // Asigna el usuario
    }

    public function showEstablecimientos($establecimientos) {
        $this->smarty->assign('establecimientos', $establecimientos);
        $this->smarty->assign('user', $this->user); // Asigna el usuario a Smarty
        $this->smarty->assign('count', count($establecimientos));
        $this->smarty->display('lista_establecimientos.tpl');
    }

    public function showError($error) {
        $this->smarty->assign('error', $error);
        $this->smarty->display('error.tpl');
    }

    public function showModifyEstablecimientoForm($establecimiento) {
        $this->smarty->assign('establecimiento', $establecimiento);
        $this->smarty->assign('user', $this->user); // Asigna el usuario a Smarty
        $this->smarty->assign('BASE_URL', BASE_URL);
        $this->smarty->display('modifyEstablecimiento_form.tpl');
    }
}
