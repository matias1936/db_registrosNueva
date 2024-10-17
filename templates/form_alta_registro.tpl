<!-- formulario de alta de registro -->
<form action="nueva" method="POST" class="my-4" style="max-width: 600px; margin: auto;">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input required name="nombre" type="text" class="form-control" id="nombre">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="accion">Acción</label>
                <select required name="accion" class="form-control" id="accion">
                    <option value="" disabled selected>Selecciona una acción</option>
                    <option value="entrada">Entrada</option>
                    <option value="salida">Salida</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input required name="fecha" type="date" class="form-control" id="fecha">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="hora">Hora</label>
                <input required name="hora" type="time" class="form-control" id="hora">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="establecimiento">Establecimiento</label>
        <select required name="establecimiento" class="form-control" id="establecimiento">
            <option value="" disabled selected>Selecciona un establecimiento</option>
            <!-- Ejemplo de opciones, reemplazar con PHP para generar dinámicamente -->
            <option value="1">Establecimiento 1</option>
            <option value="2">Establecimiento 2</option>
            <option value="3">Establecimiento 3</option>
            <!-- Puedes agregar más opciones según sea necesario -->
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
</form>
