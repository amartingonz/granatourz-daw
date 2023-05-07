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
    <label for="nombre">Nombre</label>
    <select name="data[id]">
        <?php foreach($actividades as $actividad) {
                    echo "<option value=".$actividad['id'].">".$actividad['nombre']."</option>";
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
    <textarea type="text" name="data[descripcion]" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas"></textarea>
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['descripcion'])){
            echo $_SESSION['errores']['descripcion'];
        }
    } ?></span>
    <br>
    
    <label for="imagen">Imagen</label>
    <br>
    <input type="file" name="data[imagen]" required>
    <br>
    <input type="submit" value="Crear">
</form>
