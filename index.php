<?php
// index.php

require_once 'init.php';

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'RecetaController';
$action = isset($_GET['action']) ? $_GET['action'] : 'listarRecetas';

$controllerPath = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controllerObject = new $controllerName();

    if (method_exists($controllerObject, $action)) {
        if (isset($_GET['id'])) {
            $controllerObject->$action($_GET['id']);
        } else {
            $controllerObject->$action();
        }
    } else {
        echo "La acción $action no existe en el controlador $controllerName.";
    }
} else {
    echo "El controlador $controllerName no existe.";
}
?>