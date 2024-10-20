{include file='header.tpl'}
<div class="button">
    <a href="{$BASE_URL}?action=listar_establecimientos" class="btn btn-secondary">Volver</a>
</div>
<h2>Modificar Establecimiento</h2>

<form action="{BASE_URL}modificar_establecimiento/{$establecimiento->id}" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="{$establecimiento->nombre}" class="form-control"><br><br>
    
    <label for="ciudad">Ciudad:</label>
    <input type="text" id="ciudad" name="ciudad" value="{$establecimiento->ciudad}" class="form-control"><br><br>

    <label for="direccion">Direccion:</label>
    <input type="text" id="direccion" name="direccion" value="{$establecimiento->direccion}" class="form-control"><br><br>

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen del Establecimiento:</label>
        <input type="file" class="form-control" name="imagen" id="imageToUpload">
    </div>
    
    <!-- Campo oculto para enviar la imagen actual si no se sube una nueva -->
    <input type="hidden" name="imagen_actual" value="{$establecimiento->imagen}">

    <div class="text-center">
        <button type="submit" class="btn btn-success mt-2">Modificar</button>
    </div>
</form>

{include file='footer.tpl'}
