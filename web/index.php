<?php
// carga del modelo y los controladores
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/Model.php';
require_once __DIR__ . '/../app/Controller.php';
// RUTAS
// Este array asociativo se usa para saber qué acción (función del controlador) se debe disparar
$map = array(
    'inicio' => array('clase' => 'Controller', 'metodo' => 'inicio'),
    'listar' => array('clase' => 'Controller', 'metodo' => 'listar'),
    'listarOrdenados' => array('clase' => 'Controller', 'metodo' => 'listarOrdenados'),
    'insertar' => array('clase' => 'Controller', 'metodo' => 'insertar'),
    'buscarPorNombre' => array('clase' => 'Controller', 'metodo' => 'buscarPorNombre'),
    'buscarPorEnergia' => array('clase' => 'Controller', 'metodo' => 'buscarPorEnergia'),
    'eliminarPorNombre' => array('clase' => 'Controller', 'metodo' => 'eliminarPorNombre'),
    'ver' => array('clase' => 'Controller', 'metodo' => 'ver')
);
// Parseo de la ruta
if (isset($_GET['ruta'])) {
    if (isset($map[$_GET['ruta']])) {
        $ruta = $_GET['ruta'];
    } else {
        //Este error saltará si no está definida la ruta arriba en el array asociativo
        header('Status: 404 Not Found');
        echo '<html><body><p style="color:red"><b>ERROR: No existe la ruta ' . $_GET['ruta'] . '</b></p></body></html>';
        exit;
    }
} else {
    $ruta = 'inicio';
}
$controlador = $map[$ruta];
// Ejecucion del controlador asociado a la ruta
if (method_exists($controlador['clase'], $controlador['metodo'])) {

    call_user_func(array(new $controlador['clase'], $controlador['metodo']));
} else {
    //Este error saltará si no está definida la función asociada a la ruta en Controller.php
    header('Status: 404 Not Found');
    echo '<html><body><p style="color:red"><b>ERROR: El controlador' .
        $controlador['clase'] . '->' . $controlador['metodo'] .
        'noexiste</b></p></body></html>';
}
