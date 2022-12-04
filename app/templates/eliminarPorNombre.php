<?php ob_start() ?>
<form name="formBusqueda" action="index.php?ruta=eliminarPorNombre" method="POST">
    <p>Nombre del alimento que quieres eliminar:</p>
    <input type="text" name="nombre">
    <span>(tiene que ser exacto)</span>
    <br>
    <br>
    <input type="submit" value="eliminar">
</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
