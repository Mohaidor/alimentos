<!--///////////////////////////////////-->
    <!--Se ha añadido mesajes de validación para cada campo indicando el error-->
<!--///////////////////////////////////-->

<?php ob_start() ?>
<h2>Insertar alimento</h2>
<?php if (isset($params['mensaje'])) : ?>
    <div class="mensaje"><?php echo $params['mensaje'] ?></div>
<?php endif; ?>
<form name="formInsertar" action="index.php?ruta=insertar" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $params['nombre'] ?>" />
    <?php echo isset($_POST['insertar']) && empty($_POST['nombre']) ? '<span style="color:red">El nombre no puede quedar vacío</span>' : '' ?>
    <label for="energia">Energia (Kcal)</label>
    <input type="text" name="energia" id="energia" value="<?php echo $params['energia'] ?>" />
    <?php
    echo isset($_POST['insertar']) && empty($_POST['energia']) ?
        '<span style="color:red">La cantidad de energía no puede quedar vacía</span>'
        : (isset($_POST['insertar']) && !is_numeric($_POST['energia']) ? '<span style="color:red">La cantidad de energía debe ser un número</span>' : '')
    ?>
    <label for="proteina">Proteina (g)</label>
    <input type="text" name="proteina" id="proteina" value="<?php echo $params['proteina'] ?>" />
    <?php
    echo isset($_POST['insertar']) && empty($_POST['proteina']) ?
        '<span style="color:red">La cantidad de proteina no puede quedar vacía</span>'
        : (isset($_POST['insertar']) && !is_numeric($_POST['proteina']) ? '<span style="color:red">La cantidad de proteina debe ser un número</span>' : '')
    ?>
    <label for="hc">H. de carbono (g)</label>
    <input type="text" name="hc" id="hc" value="<?php echo $params['hc'] ?>" />
    <?php
    echo isset($_POST['insertar']) && empty($_POST['hc']) ?
        '<span style="color:red">La cantidad de H. de carbono no puede quedar vacía</span>'
        : (isset($_POST['insertar']) && !is_numeric($_POST['hc']) ? '<span style="color:red">La cantidad de H. de carbono debe ser un número</span>' : '')
    ?>
    <label for="fibra">Fibra (g)</label>
    <input type="text" name="fibra" id="fibra" value="<?php echo $params['fibra'] ?>" />
    <?php
    echo isset($_POST['insertar']) && empty($_POST['fibra']) ?
        '<span style="color:red">La cantidad de fibra no puede quedar vacía</span>'
        : (isset($_POST['insertar']) && !is_numeric($_POST['fibra']) ? '<span style="color:red">La cantidad de fibra debe ser un número</span>' : '')
    ?>
    <label for="grasa">Grasa total (g)</label>
    <input type="text" name="grasa" id="grasa" value="<?php echo $params['grasa'] ?>" />
    <?php echo isset($_POST['insertar']) && empty($_POST['grasa']) ?
        '<span style="color:red">La cantidad de grasa no puede quedar vacía</span>'
        : (isset($_POST['insertar']) && !is_numeric($_POST['grasa']) ? '<span style="color:red">La cantidad de grasa debe ser un número</span>' : '')
    ?>
    <input type="submit" value="insertar" name="insertar" />
    <p>* Los valores deben referirse a 100 g del alimento</p>
</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>