<!-- He usado un list group para mostrar los siguientes datos extraidos de la base de datos -->
<div class="container mt-3">
    <div class="row row-cols-1 row-cols-md-2 g-4 m-5">
        <?php if (isset($reservas)): ?>
            <?php foreach ($reservas as $reserva): ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="./images/<?php echo $reserva['url']; ?>" class="card-img-top img-fluid fixed-size-image"
                             alt="Reserva">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $reserva['nombre']; ?></h5>
                            <p class="card-text flex-grow-1"><?php echo $reserva['descripcion']; ?></p>
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item"><strong>Fecha:</strong> <?php echo $reserva['fecha']; ?></li>
                                <li class="list-group-item"><strong>Fecha de reserva:</strong> <?php echo $reserva['fecha_reserva']; ?></li>
                                <li class="list-group-item"><strong>Localización:</strong> <?php echo $reserva['localizacion']; ?></li>
                                <li class="list-group-item"><strong>Duración:</strong> <?php echo $reserva['duracion']; ?></li>
                                <?php if (isset($_SESSION['usuario'])): ?>
                                    <li class="list-group-item">
                                        <form action="cancelar_reserva" method="post">
                                            <input type="hidden" name="data[id_reserva]"
                                                   value="<?php echo $reserva['id_reserva']; ?>">
                                            <input type="hidden" name="data[id_actividad]"
                                                   value="<?php echo $reserva['id_actividad']; ?>">
                                            <input type="hidden" name="data[id_usuario]"
                                                   value="<?php echo $_SESSION['id_usuario']; ?>">
                                            <button type="submit" class="btn btn-primary bg-danger">Cancelar</button>
                                        </form>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .fixed-size-image {
        aspect-ratio: 16/9;
    }
</style>
