<!--///////////////////////////////////-->
<?php
//comienza el guardado en cache
ob_start() 
?>
<h2>BUSCAR POR ENERGÍA</h2>
<form name="formBusqueda" action="index.php?ruta=buscarPorEnergia" method="POST">
    <label for="energia">energia alimento:</label>
    <!--Se mantienen los valores si se han introducido-->
    <input type="text" name="energia" id="energia" value="<?php echo isset($_POST['energia']) ? $_POST['energia'] : ''; ?>" />
    <!--///////////////////////////////////-->
    <!--En este div se muestran spans con los mensajes de error o de operación correcta según el caso-->
    <div>
        <?php
        //texto del span junto al input

        if (isset($_POST['buscar'])) {
            if (isset($_POST['buscar']) && empty($_POST['energia'])) {
                echo '<span style="color:red">Introduce una cantidad de energía en KCAL</span>';
            }elseif (isset($_POST['buscar']) && !is_numeric($_POST['energia'])) {
                echo '<span style="color:red">¡La energía debe ser un número!</span>';
            }elseif (isset($_POST['buscar']) && empty($params['resultado'])) {
                echo '<span style="color:red">No hay alimentos con: ' . $params['energia'] . '(KCAL)</span>';
            }elseif (isset($_POST['buscar']) && !empty($params['resultado'])) {
                echo '<span>Mostrando resultados de los alimentos que contienen: ' . $params['energia'] . '(KCAL)</span>';
            }
        }else {
            echo '<span>(Debe ser un número en KCAL)</span>';
        }
        ?>
    </div>
    <!--///////////////////////////////////-->
    <input type="submit" value="buscar" name="buscar"/>
</form>
<?php if (count($params['resultado']) > 0) : ?>
    <table>
        <tr>
            <th>alimento (por 100g)</th>
            <th>energia (Kcal)</th>
            <th>grasa (g)</th>
        </tr>
        <?php foreach ($params['resultado'] as $alimento) : ?>
            <tr>
                <td><a href="index.php?ruta=ver&id=<?php echo $alimento['id'] ?>"><?php echo $alimento['nombre'] ?></a></td>
                <td><?php echo $alimento['energia'] ?></td>
                <td><?php echo $alimento['grasatotal'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php
//Guardar la cache con el contenido de este código en la variable $contenido y borrar cache
 $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
<!--///////////////////////////////////-->
