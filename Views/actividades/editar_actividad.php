<link rel="stylesheet" href="./css/style.css">
<h2>Editar Actividad</h2>
<?php 
    if(isset($_SESSION['admin'])){
        $datos = $_SESSION['id_admin'];
    }else{
        $datos = $_SESSION['id_usuario'];
    }
?>
<form action="<?= $_ENV['BASE_URL']?>editar_actividad" method="post" enctype="multipart/form-data">

    <label for="categoria">Categoria</label>
    <br>
    <select name="data[categoria]">
        <?php foreach($categorias as $categoria) {
                    echo "<option>".$categoria['nombre']."</option>";
            }
        ?>
    </select>
    <br>
    <label for="nombre">Nombre de actividad:</label>
    <select name="data[id_actividad]">
        <?php foreach($actividades as $actividad) {
                    echo "<option value=".$actividad['id_actividad'].">".$actividad['nombre']."</option>";
            }
        ?>
    </select>
    <br>
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['nombre'])){
            echo $_SESSION['errores']['nombre'];
        }
    }?></span>
    <br>
    <label for="descripcion">Descripcion</label>
    <br>
    <textarea name="data[descripcion]" id="descripcion" cols="30" rows="10"></textarea>
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['descripcion'])){
            echo $_SESSION['errores']['descripcion'];
        }
    } ?></span>
     <br>
    <label for="localizacion">Localización:</label>
    <input type="text" name="data[localizacion]" id="localizacion">
    <br>
    <label for="hora">Hora:</label>
    <br>
    <input type="time" name="data[hora]" id="hora">
    <br>
    <label for="fecha">Fecha:</label>
    <br>
    <input type="date" name="data[fecha]" id="fecha">
    <br>
    <label for="capacidad">Capacidad:</label>
    <br>
    <input type="number" name="data[capacidad]" id="capacidad">
    <br>
    <label for="url">Imagen</label>
    <br>
    <input type="file" name="data[url]" id="url">
    <br>
    <input type="submit" value="Crear">
</form>
