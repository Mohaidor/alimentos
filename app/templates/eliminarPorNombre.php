<!--///////////////////////////////////-->
<?php
//comienza el guardado en cache
ob_start()
?>
<form name="formBusqueda" action="index.php?ruta=eliminarPorNombre" method="POST">
    <label for="nombre">Nombre del alimento que quieres eliminar:</label>
    <!--Se mantienen los valores si se han introducido-->
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
    <!--En este span se muestran los mensajes de error o de operación correcta según el caso-->
    <span <?php echo !empty($params['error']) ? 'style="color:red"' : '' ?>>
        <?php echo !empty($params['error']) ? $params['error'] : (!empty($params['correcto']) ? $params['correcto'] : '(tiene que ser exacto)') ?>
    </span>
    <br>
    <input type="submit" value="eliminar">
</form>
<?php
//Guardar la cache con el contenido de este código en la variable $contenido y borrar cache
$contenido = ob_get_clean()
?>
<?php include 'layout.php' ?>
<!--///////////////////////////////////-->