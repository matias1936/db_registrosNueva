<?php
include_once './libs/Smarty.class.php';
use Smarty\Smarty;
class EstablecimientoView {
    private $smarty;

    public function __construct($smarty) {
        $this->smarty = $smarty;
    }

    public function showEstablecimientos($establecimientos) {
        $this->smarty->assign('establecimientos', $establecimientos);
        $this->smarty->display('lista_establecimientos.tpl');
    }
}
