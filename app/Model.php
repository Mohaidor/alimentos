<?php
class Model
{
    ///////////////////////////////////
    //Esta función recibe por una sentencia que NO devuelve datos (insert, delete o update) y la ejecuta
    private function consultaQueNoDevuelveDatos($sql)
    {
        /*Como una consulta que no devuelve datos siempre da true a menos que haya error;
        He modificado este método para que devuelva false si no se ha modificado nada y asi poder dar mensajes descriptivos*/
        $this->conexion->query($sql);
        return $this->conexion->affected_rows ? true : false;
        //return $this->conexion->query($sql);
    }

    //Esta función obtiene todos los alimentos de la BD, para el apartado "ver alimentos según campo y sentido"
    public function dameAlimentosOrdenados($campo, $sentido)
    {
        $sql = "SELECT * FROM alimentos ORDER BY $campo $sentido";
        return $this->devolverAlimentosSelect($sql);
    }

    //Esta función obtiene los alimentos que contienen la cadena recibida, para el apartado "buscar por energía"
    public function buscarAlimentosPorEnergia($energia)
    {
        $sql = "SELECT * FROM alimentos WHERE energia = $energia";
        return $this->devolverAlimentosSelect($sql);
    }

    //Esta función elimina el alimentos (sólo uno) cuyo nombre es la nombre recibido
    public function eliminarAlimentosPorNombre($nombre)
    {
        //He añadido al delete la sentencia limit 1 para limitar a 1 el numero de elementos eliminados en caso de existir varios con el mismo nombre
        $sql = "DELETE FROM alimentos WHERE nombre = '$nombre' LIMIT 1";
        return $this->consultaQueNoDevuelveDatos($sql);
    }
    ///////////////////////////////////

    //Código dado por el ejercicio:

    protected $conexion;
    //Esta función sólo conecta con la BD y se llama automáticamente al crear el objeto Model
    public function __construct(
        $dbhost,
        $dbuser,
        $dbpass,
        $dbname
    ) {
        $mvc_bd_conexion = new mysqli(
            $dbhost,
            $dbuser,
            $dbpass,
            $dbname
        );
        $error = $mvc_bd_conexion->connect_errno;
        if ($error != null) {
            echo "<p>Error " . $error . "conectando a la base de datos: ";
            echo $mvc_bd_conexion->connect_error . "</p>";
            exit();
        }
        $this->conexion = $mvc_bd_conexion;
    }
    //Esta función recibe por parámetro una sentencia SELECT y devuelve un array de alimentos
    //El array será accesible tanto con posiciones numéricas como asociativas, al ser fetch_array
    private function devolverAlimentosSelect($sql)
    {
        $consulta = $this->conexion->query($sql);
        $alimentos = array();
        while ($resultado = $consulta->fetch_array()) {
            $alimentos[] = $resultado;
        }
        return $alimentos;
    }
    /*************************************/
    //Esta función obtiene todos los alimentos de la BD, para el apartado "ver alimentos"
    public function dameAlimentos()
    {
        $sql = "SELECT * FROM alimentos";
        return $this->devolverAlimentosSelect($sql);
    }
    //Esta función obtiene los alimentos que contienen la cadena recibida, para el apartado "buscar por nombre"
    public function buscarAlimentosPorNombre($nombre)
    {
        $sql = "SELECT * from alimentos where nombre like '%" . $nombre . "%'";
        return $this->devolverAlimentosSelect($sql);
    }
    //Esta función obtiene el alimentos (sólo uno) cuya id es la id recibida, para cuando hacemos click sobre un alimento
    public function dameAlimento($id)
    {
        $sql = "SELECT * from alimentos where id=" . $id;
        return $this->devolverAlimentosSelect($sql)[0];
    }
    //Esta función obtiene los alimentos que contienen la cadena recibida, para el apartado "buscar por nombre"
    public function insertarAlimento(
        $n,
        $e,
        $p,
        $hc,
        $f,
        $g
    ) {
        $sql = "INSERT INTO alimentos (nombre, energia, proteina, hidratocarbono, fibra, grasatotal)
                values ('" . $n . "'," . $e . "," . $p . "," . $hc . "," . $f . "," . $g . ")";
        return $this->consultaQueNoDevuelveDatos($sql);
    }
    /*************************************/
    //Esta es una pequeña función de validación que se ha usado para el formulario (podría mejorarse)
    public function validarDatos(
        $n,
        $e,
        $p,
        $hc,
        $f,
        $g
    ) {
        return (is_string($n) & is_numeric($e) &
            is_numeric($p) &
            is_numeric($hc) &
            is_numeric($f) & is_numeric($g));
    }
}
