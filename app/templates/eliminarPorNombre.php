<?php ob_start() ?>
<form name="formBusqueda" action="index.php?ruta=eliminarPorNombre" method="POST">
    <label for="nombre">Nombre del alimento que quieres eliminar:</label>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
    <span <?php echo !empty($params['error']) ? 'style="color:red"' : '' ?>>
        <?php echo !empty($params['error']) ? $params['error'] : (!empty($params['correcto']) ? $params['correcto'] : '(tiene que ser exacto)') ?>
    </span>
    <br>
    <input type="submit" value="eliminar">
</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>