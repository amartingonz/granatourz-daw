<h2>MIS RESERVAS</h2>
<table>
    <tr>
            <td>Provincia</td>
            <td>Localidad</td>
            <td>Direccion</td>
            <td>Coste</td>
            <td>Fecha</td>
            <td>Hora</td>
    <tr>
    <?php if(isset($reservas)){?>
        <?php foreach($reservas as $reserva):?>
                    <td><?= $reserva['provincia']?></td>
                    <td><?= $reserva['localidad']?></td>
                    <td><?= $reserva['direccion']?></td>
                    <td><?= $reserva['coste']?>€</td>
                    <td><?= $reserva['fecha']?></td>
                    <td><?= $reserva['hora']?></td>
        </tr>
        <?php endforeach; ?>
    <?php }?>
</table>
<hr>
<br>