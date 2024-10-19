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
        $this->smarty->assign('user', $this->user);
        $this->smarty->assign('registros', $registros);
        $this->smarty->assign('establecimientos', $establecimientos);
        $this->smarty->assign('count', count($registros));
        // Renderiza la plantilla `lista_registros.tpl`
        $this->smarty->display('lista_registros.tpl');
    }

    public function showError($error) {
        // Asigna el error a Smarty y muestra la plantilla `error.tpl`
        $this->smarty->assign('error', $error);
        $this->smarty->display('error.tpl');
    }
    public function showDetalleRegistro($registro, $establecimiento) {
        // Crear instancia de Smarty
        $smarty = new Smarty();
    
        // Verificar si el registro y el establecimiento no son nulos
        if ($registro && $establecimiento) {
            // Crear un arreglo con todos los datos necesarios
            $data = [
                'registro_nombre' => $registro->nombre,
                'registro_fecha' => $registro->fecha,
                'registro_hora' => $registro->hora,
                'establecimiento_nombre' => $establecimiento->nombre,
                'establecimiento_direccion' => $establecimiento->direccion,
                'establecimiento_ciudad' => $establecimiento->ciudad,
                'establecimiento_imagen' => $establecimiento->imagen
            ];
    
            // Asignar el arreglo a Smarty
            $smarty->assign('data', $data);
        }
    
        // Mostrar la plantilla
        $smarty->display('detalle_registro.tpl');
    }
    
    
    
    
}
