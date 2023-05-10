
<h2>Crear Reserva</h2>

<?php 

    if(isset($_SESSION['admin'])){
        $id = $_SESSION['id_admin'];
    }
    if(isset($_SESSION['usuario'])){
        $id = $_SESSION['id_usuario'];
    }
    if(isset($_SESSION['total'])){
        $total = $_SESSION['total'];
    }
?>


<form action="<?= $_ENV['BASE_URL']?>crear_reserva" method="post">

    <input type="hidden" name="data[usuario_id]" value="<?= $id ?>">
    <br>
    <input type="hidden" name="data[usuario_id]" value="<?= $id ?>">
    <br>
    <input type="hidden" name="data[usuario_id]" value="<?= $id ?>">
    <br>
    <input type="submit" value="Confirmar">

</form>

