<?php
//comienza el guardado en cache
ob_start()
?>
<h2>Buscar por nombre</h2>
<form name="formBusqueda" action="index.php?ruta=buscarPorNombre" method="POST">
    <label for="nombre">nombre alimento:</label>
    <!--Se mantienen los valores si se han introducido-->
    <input type="text" name="nombre" id="nombre" value="<?php echo $params['nombre'] ?>" />
    <!--///////////////////////////////////-->
    <!--En este div se muestran spans con los mensajes de error o de operación correcta según el caso-->
    <div>
        <?php
        //texto del span junto al input
        if (isset($_POST['buscar'])) {
            if (empty($_POST['nombre'])) {
                echo '<span style="color:red">El nombre no puede quedar vacío</span>';
            } elseif (empty($params['resultado'])) {
                echo '<span style="color:red">No hay alimentos que contengan: \'' . $params['nombre'] . '\'</span>';
            } elseif (!empty($params['resultado'])) {
                echo '<span>Mostrando resultados de los alimentos que contienen: \'' . $params['nombre'] . '\'</span>';
            }
        } else {
            echo '<span>(puedes escribir sólo una parte del nombre)</span>';
        }

        ?>
    </div>
    <!--///////////////////////////////////-->
    <input type="submit" value="buscar" name="buscar" />
</form>
<?php if (count($params['resultado']) > 0) : ?>
    <table>
        <tr>
            <th>alimento (por 100g)</th>
            <th>energía (Kcal)</th>
            <th>grasa (g)</th>
        </tr>
        <?php foreach ($params['resultado'] as $alimento) : ?>
            <tr>
                <td><a href="index.php?ruta=ver&id=<?php echo
                                                    $alimento['id'] ?>"><?php echo $alimento['nombre'] ?></a></td>
                <td><?php echo $alimento['energia'] ?></td>
                <td><?php echo $alimento['grasatotal'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php
//Guardar la cache con el contenido de este código en la variable $contenido y borrar cache
$contenido = ob_get_clean()
?>
<?php include 'layout.php' ?>