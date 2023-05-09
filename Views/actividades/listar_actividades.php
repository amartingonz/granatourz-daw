
<h2>Actividades</h2>
<table>
    <tr>
            <td>Categoria_ID</td>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Precio</td>
            <td>Stock</td>
            <td>Imagen</td>
    <tr>
    <?php if(isset($actividades)){?>
    <?php foreach($actividades as $actividad):?>
                <?php if($actividad['estado'] != 0):?>
                    <td><?= $actividad['id_categoria']?></td>
                    <td><?= $actividad['nombre']?></td>
                    <td><?= $actividad['descripcion']?></td>
                    <td><?= $actividad['stock']?></td>
                    <td><img src="<?="./images/".$actividad['imagen']?>" width="100px"></td>
                    <td>
                        <form action="anadir_carrito" method="post">
                            <input type="hidden" name="stock" value="<?= $actividad['stock']?>">
                            <input type="number" name="unidades" min="1" value="1" max="<?= $actividad['stock']?>">
                            <input type="hidden" name="cod" value="<?= $actividad['id'] ?>">
                            <input type="submit" value="Añadir">
                        </form>
                    </td>
                </tr>
                <?php endif;?>
    <?php endforeach; ?>
    <?php }?>
</table>
<hr>
<br>