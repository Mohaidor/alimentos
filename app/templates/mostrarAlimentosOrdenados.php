<!--///////////////////////////////////-->
<?php
//comienza el guardado en cache
ob_start()
?>
<h2>Ver alimentos Ordenados</h2>
<table>
    <tr>
        <th>alimento (por 100g)</th>
        <th>energia (Kcal)</th>
        <th>grasa (g)</th>
    </tr>
    <?php foreach ($params['alimentos'] as $alimento) : ?>
        <tr>
            <td><a href="index.php?ruta=ver&id=<?php echo $alimento['id'] ?>"><?php echo $alimento['nombre'] ?></a></td>
            <td><?php echo $alimento['energia'] ?></td>
            <td><?php echo $alimento['grasatotal'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<form name="formBusqueda" action="index.php?ruta=listarOrdenados" method="POST">
    <span>Ordenar por:</span>
    <!--Se mantienen los valores si se han introducido-->
    <select name="campo">
        <option value="nombre" <?php echo (isset($_POST['campo']) && $_POST['campo'] == 'nombre') ? 'selected' : ''; ?>>Nombre</option>
        <option value="energia" <?php echo (isset($_POST['campo']) && $_POST['campo'] == 'energia') ? 'selected' : ''; ?>>Energía</option>
        <option value="grasatotal" <?php echo (isset($_POST['campo']) && $_POST['campo'] == 'grasa') ? 'selected' : ''; ?>>Grasa</option>
    </select>
    <span>en sentido:</span>
    <!--Se mantienen los valores si se han introducido-->
    <select name="sentido">
        <option value="asc" <?php echo (isset($_POST['sentido']) && $_POST['sentido'] == 'asc') ? 'selected' : ''; ?>>ascendente</option>
        <option value="desc" <?php echo (isset($_POST['sentido']) && $_POST['sentido'] == 'desc') ? 'selected' : ''; ?>>descendente</option>
    </select>
    <input type="submit" value="Ordenar">
</form>
<?php
//Guardar la cache con el contenido de este código en la variable $contenido y borrar cache
$contenido = ob_get_clean() 
?>
<?php include 'layout.php' ?>
<!--///////////////////////////////////-->