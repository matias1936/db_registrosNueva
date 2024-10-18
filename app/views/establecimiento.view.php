<?php
include_once './libs/Smarty.class.php';
use Smarty\Smarty;

class EstablecimientoView {

    public function showEstablecimientos($establecimientos) {
        // Crear instancia de Smarty
        $smarty = new Smarty();

        // Asignar la variable 'establecimientos' a Smarty
        $smarty->assign('establecimientos', $establecimientos);

        // Mostrar la plantilla 'lista_establecimientos.tpl'
        $smarty->display('lista_establecimientos.tpl');
    }
}
