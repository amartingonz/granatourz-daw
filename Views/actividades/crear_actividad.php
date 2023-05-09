<!-- FORMULARIO PARA CREAR ACTIVIDAD -->

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4 p-5">
            <h2 class="text-center mt-3">Crear Actividad</h2>
            <form action="<?= $_ENV['BASE_URL']?>crear_actividad" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate>

                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select name="data[categoria]" class="form-control">
                        <?php foreach($categorias as $categoria) {
                            echo "<option>".$categoria['nombre']."</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre de la actividad:</label>
                    <input type="text" name="data[nombre]" id="nombre" class="form-control" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['nombre'])){
                                echo $_SESSION['errores']['nombre'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="duracion">Duración (en minutos):</label>
                    <input type="number" name="data[duracion]" id="duracion" class="form-control" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['duracion'])){
                                echo $_SESSION['errores']['duracion'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="data[descripcion]" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="localizacion">Localización:</label>
                    <input type="text" name="data[localizacion]" id="localizacion" class="form-control" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['localizacion'])){
                                echo $_SESSION['errores']['localizacion'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="hora">Hora:</label>
                    <input type="time" name="data[hora]" id="hora" class="form-control" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['hora'])){
                                echo $_SESSION['errores']['hora'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="data[fecha]" id="fecha" class="form-control" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['fecha'])){
                                echo $_SESSION['errores']['fecha'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" name="data[capacidad]" id="capacidad" class="form-control" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['capacidad'])){
                                echo $_SESSION['errores']['capacidad'];
                            }
                        } ?>
                    </span>
                </div>
                <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" class="form-control-file">
                <span class="text-danger">
                    <?php if(isset($_SESSION['errores'])){
                        if(isset($_SESSION['errores']['imagen'])){
                            echo $_SESSION['errores']['imagen'];
                        }
                    } ?>
                </span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block mt-4">Crear actividad</button>
            </div>

        </form>
    </div>
</div>

