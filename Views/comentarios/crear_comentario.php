<form action="crear_comentario" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="hidden" name="data[id_actividad]" value="<?= $actividad['id_actividad'] ?>">
    <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">
  </div>
  <div class="form-group">
    <label for="url">Imagen:</label>
    <input type="file" class="form-control-file" name="data[url]" id="url">
  </div>
  <div class="form-group">
    <label for="texto">Comentario:</label>
    <textarea class="form-control" name="data[texto]" id="texto" rows="5"></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-success">Enviar</button>
</form>
