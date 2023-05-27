<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (isset($mensaje)) {
                    echo '<div class="card border-warning mb-3">
                            <div class="card-header bg-warning text-white">Aviso</div>
                            <div class="card-body">
                                <p class="card-text">' . $mensaje . '</p>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>