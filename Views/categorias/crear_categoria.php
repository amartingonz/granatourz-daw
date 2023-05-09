<!-- FORMULARIO PARA CREAR CATEGORIA -->

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4 p-5">
            <h2 class="text-center mt-3">Crear Categoría</h2>
            <form action="<?= $_ENV['BASE_URL']?>crear_categoria" method="post" class="needs-validation mt-4" novalidate>

                <div class="form-group">
                    <label for="nombre">Nombre de la categoría:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['nombre'])){
                                echo $_SESSION['errores']['nombre'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-block mt-4">Crear categoría</button>
                </div>

            </form>
        </div>
    </div>
</div>
