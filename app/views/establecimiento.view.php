<?php
require_once './libs/Smarty.class.php';
use Smarty\Smarty;

class EstablecimientoView {
    private $smarty;

    public function __construct($smarty) {
        $this->smarty = new Smarty();
    }

    public function showEstablecimientos($establecimientos) {
        // Assign variables to Smarty
        $this->smarty->assign('establecimientos', $establecimientos);
        $this->smarty->assign('count', count($establecimientos));
        
        // Render the template `lista_establecimientos.tpl`
        $this->smarty->display('lista_establecimientos.tpl');
    }

    public function showError($error) {
        // Assign the error to Smarty and show the template `error.tpl`
        $this->smarty->assign('error', $error);
        $this->smarty->display('error.tpl');
    }
}