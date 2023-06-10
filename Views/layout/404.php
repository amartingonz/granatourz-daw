<!-- He creado esta página para el error si se introduce una ruta que no reconoce el router o es erronea -->
<div class="error-container d-flex flex-column justify-content-center align-items-center mt-4">
    <h1 class="display-4">Error 404</h1>
    <p class="lead">La página que estás buscando no se encuentra.</p>
    <a href="<?= $_ENV['BASE_URL']?>" class="btn btn-primary">Volver a la página principal</a>
</div>
