<!-- Botón para desplegar el formulario -->
<div class="text-center">
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#formEstablecimiento" aria-expanded="false" aria-controls="formEstablecimiento">
        Cargar Nuevo Establecimiento
    </button>
</div>

<!-- Formulario que se oculta y muestra -->
<div class="collapse" id="formEstablecimiento">
    <div class="card card-body">
        <h4 class="mb-3 text-center">Subir Establecimiento</h4>
        <form action="upload_establecimiento.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Establecimiento:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad:</label>
                <input type="text" class="form-control" name="ciudad" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control" name="direccion" required>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Establecimiento:</label>
                <input type="file" class="form-control" name="imagen" id="imageToUpload" required>
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-success" value="Subir Establecimiento">
            </div>
        </form>
    </div>
</div>
