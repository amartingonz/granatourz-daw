
<h2>Crear Actividad</h2>
<form action="<?= $_ENV['BASE_URL']?>crear_actividad" method="post" enctype="multipart/form-data">
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
    <br>
    <input type="text" name="data[nombre]" id="nombre">
    <br>
    <label for="duracion">Duración:</label>
    <br>
    <input type="number" name="data[duracion]" id="duracion">
    <br>
    <label for="descripcion">Descripcion</label>
    <br>
    <textarea name="data[descripcion]" id="descripcion" cols="30" rows="10">Descripción</textarea>
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