<!--///////////////////////////////////-->
<?php
//comienza el guardado en cache
ob_start()
?>
<form name="formBusqueda" action="index.php?ruta=eliminarPorNombre" method="POST">
    <label for="nombre">Nombre del alimento que quieres eliminar:</label>
    <!--Se mantienen los valores si se han introducido-->
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
    <!--///////////////////////////////////-->
    <!--En este div se muestran spans con los mensajes de error o de operación correcta según el caso-->
    <div>
        <?php
        //texto del span junto al input
        if (isset($_POST['eliminar'])) {
            if (empty($_POST['nombre'])) {
                echo '<span style="color:red">El nombre no puede quedar vacío</span>';
            } elseif (empty($params['resultado'])) {
                echo '<span style="color:red">No hay alimento: \'' . $params['nombre'] . '\'</span>';
            } elseif (!empty($params['resultado'])) {
                echo '<span>Se ha eliminado correctamente la primera ocurrencia de: \'' . $params['nombre']  . '\'</span>';
            }
        } else {
            echo '<span>(puedes escribir sólo una parte del nombre)</span>';
        }
        ?>
    </div>
    <!--///////////////////////////////////-->
    <br>
    <input type="submit" value="eliminar" name="eliminar">
</form>
<?php
//Guardar la cache con el contenido de este código en la variable $contenido y borrar cache
$contenido = ob_get_clean()
?>
<?php include 'layout.php' ?>
<!--///////////////////////////////////-->