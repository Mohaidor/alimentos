<?php
class Controller
{
    ///////////////////////////////////
    //Acción para el apartado "ver alimentos  ordenados"
    //En $params tenemos la columna a ordernar, sentido de orden y un array alimentos, que llenamos llamando al método dameAlimentos de Model
    public function listarOrdenados()
    {
        $params = array('campo' => '', 'sentido' => '', 'alimentos' => array());
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );

        //Si se ha enviado el form muestro el resultado según lo pedidio por el user
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params['campo'] = $_POST['campo'];
            $params['sentido'] = $_POST['sentido'];
            $params['alimentos'] = $m->dameAlimentosOrdenados($params['campo'], $params['sentido']);
            require __DIR__ . '/templates/mostrarAlimentosOrdenados.php'; //vista de este apartado
        } else {
            //Si noo muestro la tabla como en listar()
            $params['alimentos'] = $m->dameAlimentos();
            require __DIR__ . '/templates/mostrarAlimentosOrdenados.php'; //vista de este apartado
        }
    }

    //Acción para el apartado "buscar por nombre"
    //En $params tenemos un campo para el input del nombre, y un array resultado que llenamos llamando al método buscarAlimentosPorNombre de Model
    public function buscarPorNombre()
    {
        //Añado parámetro para el mensaje de error y el mensaje de correcto
        $params = array('nombre' => '', 'resultado' => array(), 'error' => '', 'correcto' => '');
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Si se envia vacio el campo nombre-> Error
            if (empty($_POST['nombre'])) {
                $params['error'] = 'El nombre no puede quedar vacio';
            } else {
                $params['nombre'] = $_POST['nombre'];
                $params['resultado'] = $m->buscarAlimentosPorNombre($params['nombre']);

                //Si no hay resultado->Error
                if (empty($params['resultado'])) {
                    $params['error'] = 'No hay alimentos que contengan: \'' . $params['nombre'] . '\'';
                } else {
                    //Si se ha encontrado alimento->muestro mensaje correcto
                    $params['correcto'] = 'Mostrando resultados de los alimentos que contienen: \'' . $params['nombre'] . '\'';
                }
            }
        }
        require __DIR__ . '/templates/buscarPorNombre.php'; //vista de este apartado
    }
    //Acción para el apartado "buscar por Energia"
    //En $params tenemos un campo para el input de la energia, y un array resultado que llenamos llamando al método buscarAlimentosPorEnergia de Model
    public function buscarPorEnergia()
    {
        $params = array('energia' => '', 'resultado' => array(), 'error' => '', 'correcto' => '');
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Si se envia vacio el campo energia-> Error
            if (empty($_POST['energia'])) {
                $params['error'] = 'Introduce un número de energía en KCAL';
            } elseif (!is_numeric($_POST['energia'])) {
                //Si se envia una cadena en  el campo energia-> Error
                $params['error'] = '¡La energía debe ser un número!';
            } else {
                $params['energia'] = $_POST['energia'];
                $params['resultado'] = $m->buscarAlimentosPorEnergia($params['energia']);

                //Si no hay resultado->Error
                if (empty($params['resultado'])) {
                    $params['error'] = 'No hay alimentos con: ' . $params['energia'] . '(KCAL)';
                } else {
                    //Si se ha encontrado alimento->muestro mensaje correcto
                    $params['correcto'] = 'Mostrando resultados de los alimentos con: ' . $params['energia'] . '(KCAL)';
                }
            }
        }
        require __DIR__ . '/templates/buscarPorEnergia.php'; //vista de este apartado
    }

    //Acción para el apartado "eliminar por Nombre"
    //En $params tenemos un campo para el input del nombre, y un array resultado que llenamos llamando al método eliminarPorNombre de Model
    public function eliminarPorNombre()
    {
        $params = array('nombre' => '', 'resultado' => array(), 'error' => '', 'correcto' => '');
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Si se envia vacio el campo energia-> Error
            if (empty($_POST['nombre'])) {
                $params['error'] = 'El nombre no puede quedar vacio';
            } else {
                $params['nombre'] = $_POST['nombre'];
                $params['resultado'] = $m->eliminarAlimentosPorNombre($params['nombre']);

                //Si no hay resultado->Error
                if (empty($params['resultado'])) {
                    $params['error'] = 'No hay alimento: \'' . $params['nombre'] . '\'';
                } else {
                    //Si se ha eliminado alimento->muestro mensaje correcto
                    $params['correcto'] = 'Se ha eliminado correctamente la primera ocurrencia de: \'' . $params['nombre']  . '\'';
                }
            }
        }
        require __DIR__ . '/templates/eliminarPorNombre.php'; //vista de este apartado
    }
    ///////////////////////////////////



    //Código dado por el ejercicio:


    //Acción para el apartado "inicio"
    //El único dato que manejamos es la fecha actual, que la obtenemos con date
    public function inicio()
    {
        $params = array('fecha' => date('d-m-y'));
        require __DIR__ . '/templates/inicio.php';
        //vista de este apartado
    }
    //Acción para el apartado "ver alimentos"
    //En $params tenemos un array alimentos, que llenamos llamando al método dameAlimentos de Model
    public function listar()
    {
        $params = array('alimentos' => array());
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );
        $params['alimentos'] = $m->dameAlimentos();
        require __DIR__ . '/templates/mostrarAlimentos.php'; //vista de este apartado
    }
    //Acción para el apartado "insertar alimento"
    //En $params tenemos un campo para cada input, que llenamos al enviar el formulario
    public function insertar()
    {
        $params = array(
            'nombre' => '', 'energia' => '',
            'proteina' => '', 'hc' => '', 'fibra' => '', 'grasa' => '',
            'mensaje' => NULL
        );
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($m->validarDatos(
                $_POST['nombre'],
                $_POST['energia'],
                $_POST['proteina'],
                $_POST['hc'],
                $_POST['fibra'],
                $_POST['grasa']
            )) {
                $m->insertarAlimento(
                    $_POST['nombre'],
                    $_POST['energia'],
                    $_POST['proteina'],
                    $_POST['hc'],
                    $_POST['fibra'],
                    $_POST['grasa']
                );
                header('Location:index.php?ruta=listar');
            } else {
                $params['nombre'] = $_POST['nombre'];
                $params['energia'] = $_POST['energia'];
                $params['proteina'] = $_POST['proteina'];
                $params['hc'] = $_POST['hc'];
                $params['fibra'] = $_POST['fibra'];
                $params['grasa'] = $_POST['grasa'];
                $params['mensaje'] = 'No se ha podido insertar el alimento. Revisa el formulario';
            }
        }
        require __DIR__ . '/templates/insertarAlimento.php'; //vista de este apartado
    }
    //Acción para cuando se pulsa encima del nombre de un alimento
    //Este es un poco diferente, ya que decimos directamente que $params es el alimento
    public function ver()
    {
        if (!isset($_GET['id'])) {
            throw new Exception('Pagina no encontrada');
        }
        $id = $_GET['id'];
        $m = new Model(
            Config::$mvc_bd_hostname,
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave,
            Config::$mvc_bd_nombre
        );
        $alimento = $m->dameAlimento($id);
        require __DIR__ . '/templates/verAlimento.php';
        //vista de este apartado
    }
}
