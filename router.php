<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/registro.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/establecimientos.controller.php';


// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// listar  -> RegistroController->showRegistro();
// nueva  -> RegistroController->addRegistro();
// eliminar/:ID  -> RegistroController->deleteRegistro($id);
// finalizar/:ID -> RegistroController->finishRegistro($id);
// ver/:ID -> RegistroController->view($id); COMPLETAR

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':

        //verifica si existe una sesión activa con un usuario autenticado 
        $controller = new RegistroController($res);
        $controller->showRegistros();
        break;
    case 'verRegistro_establecimiento':
        $establecimientocontroller = new EstablecimientoController($res);
        $establecimientocontroller->verRegistrosEstablecimiento(); // Pass the ID of the establishment
        break;
    case 'listar_establecimientos': 
        $establecimientocontroller = new EstablecimientoController($res);
        $establecimientocontroller->showEstablecimientos(); 
        break;
    case 'cargar_establecimiento':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $establecimientocontroller = new EstablecimientoController($res);
        $establecimientocontroller->addEstablecimiento(); // Llama a la función para agregar el establecimiento
        break;
    case 'eliminar_establecimiento':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $establecimientocontroller = new EstablecimientoController($res);
        $establecimientocontroller->deleteEstablecimiento();
        break;
    case 'nueva':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RegistroController($res);
        $controller->addRegistro();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
         // Verifica que el usuario esté logueado o redirige a login
        $controller = new RegistroController($res);
        $controller->deleteRegistro($params[1]);
        break;
    case 'modificar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        //sessionAuthMiddleware($res);
        //verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new RegistroController($res);
        $controller->updateRegistro($params[1]);
        break;
    case 'formModificar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new RegistroController($res);
        $controller->mostrarFormModificar($params[1]);
        break;
        
    case 'modificar_establecimiento':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new EstablecimientoController($res);
        $controller->updateEstablecimiento($params[1]);
        break;
    case 'formModificarEstablecimiento':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new EstablecimientoController($res);
        $controller->mostrarFormModificarEstablecimiento($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
    case 'buscar': 
        $controller = new RegistroController($res);
        $controller->buscarRegistros();
            break;
    case 'verDetalle_registro':
        $controller = new RegistroController($res);
        $controller->verDetalleRegistro($params[1]); // Manda el ID del registro
        break;
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}