<?php
require_once './libs/Smarty.class.php';
use Smarty\Smarty;

class RegistroView {
    private $user = null;
    private $smarty;

    public function __construct($user) {
        $this->user = $user;
        $this->smarty = new Smarty();

        // Configura las rutas de Smarty
        $this->smarty->setTemplateDir('templates/');
        $this->smarty->setCompileDir('templates_c/'); // Asegúrate de tener este directorio con permisos de escritura.
    }

    public function showRegistros($registros, $establecimientos) {
        // Asigna las variables a Smarty
        
        $this->smarty->assign('registros', $registros);
        $this->smarty->assign('establecimientos', $establecimientos);
        // Verifica que $registros sea un array antes de contar
        if (is_array($registros)) {
            $this->smarty->assign('count', count($registros));
        } else {
            $this->smarty->assign('count', 0); // O maneja el caso de otra manera
        }
        // Renderiza la plantilla `lista_registros.tpl`
        $this->smarty->display('lista_registros.tpl');
    }

    public function showModifyRegistroForm($registro,$establecimientos) {
    // Asignar el registro a la plantilla

    $this->smarty->assign('registro', $registro);
    $this->smarty->assign('establecimientos', $establecimientos);
    $this->smarty->assign('BASE_URL', BASE_URL);
    
    // Mostrar la plantilla de modificación
    $this->smarty->display('modify_registro_form.tpl');
}


    public function showRegistrosByEstablecimiento($registros, $establecimiento, $establecimientos) {
        // Asigna las variables a Smarty
        $this->smarty->assign('user', $this->user);
        $this->smarty->assign('registros', $registros);
        $this->smarty->assign('establecimiento', $establecimiento);
        $this->smarty->assign('establecimientos', $establecimientos);
        
        // Verifica que $registros sea un array antes de contar
        if (is_array($registros)) {
            $this->smarty->assign('count', count($registros));
        } else {
            $this->smarty->assign('count', 0); // O maneja el caso de otra manera
        }
        
        // Renderiza la plantilla `lista_registros.tpl`
        $this->smarty->display('lista_registrosByEstablecimiento.tpl');
    }










    public function showError($error) {
        // Asigna el error a Smarty y muestra la plantilla `error.tpl`
        $this->smarty->assign('error', $error);
        $this->smarty->display('error.tpl');
    }
    public function showDetalleRegistro($registro, $establecimiento) {
        // Crear instancia de Smarty
        $this->smarty->assign('registro', $registro);
        $this->smarty->assign('establecimiento', $establecimiento);
        $this->smarty->assign('BASE_URL', BASE_URL);

        $this->smarty->display( 'detalle_registro.tpl');
        
    }
    
    
    
    
}
