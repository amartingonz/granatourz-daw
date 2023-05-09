<link rel="stylesheet" href="./css/style.css">

<?php
if(isset($_SESSION['admin'])){
    $datos = $_SESSION['id_admin'];
}else{
    $datos = $_SESSION['id_usuario'];
}
?>

<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4 p-5">
            <h2 class="text-center mt-3">Editar Datos de Usuario</h2>
            <form action="<?= $_ENV['BASE_URL']?>editar_datos" method="post" class="needs-validation mt-4" novalidate>
                <input type="hidden" name="data[id_usuario]" value="<?= $datos ?>" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="nombre" class="form-control" name="data[nombre]" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['nombre'])){
                                echo $_SESSION['errores']['nombre'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="apellidos" class="form-control" name="data[apellidos]" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['apellidos'])){
                                echo $_SESSION['errores']['apellidos'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="email" class="form-control" name="data[email]" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['email'])){
                                echo $_SESSION['errores']['email'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" class="form-control" name="data[telefono]" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['telefono'])){
                                echo $_SESSION['errores']['telefono'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="data[password]" required>
                    <span class="text-danger">
                        <?php if(isset($_SESSION['errores'])){
                            if(isset($_SESSION['errores']['password'])){
                                echo $_SESSION['errores']['password'];
                            }
                        } ?>
                    </span>
                </div>

                <div class="text-center p-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>
