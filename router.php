<?php
require_once './app/task.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        showTasks();
        break;
    case 'nueva':
        addTask();
        break;
    case 'eliminar':
        deleteTask($params[1]);
        break;
    case 'finalizar':
        finishTask($params[1]);
        break; 
    default: 
        echo "404 Page Not Found";
        break;
}