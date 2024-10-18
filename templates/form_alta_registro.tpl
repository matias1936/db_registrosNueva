<!-- Botón para desplegar el formulario de registro -->
<div class="text-center">
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#formRegistro" aria-expanded="false" aria-controls="formRegistro">
        Cargar Nuevo Registro
    </button>
</div>

<!-- Formulario que se oculta y muestra -->
<div class="collapse" id="formRegistro">
    <div class="card card-body">
        <h4 class="mb-3 text-center">Subir Registro</h4>
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
                <select required name="establecimiento_id" class="form-control" id="establecimiento">
                    <option value="" disabled selected>Selecciona un establecimiento</option>
                    {foreach from=$establecimientos item=establecimiento}
                        <option value="{$establecimiento->id|escape}">
                            {$establecimiento->nombre|escape}
                        </option>
                    {/foreach}
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success mt-2">Guardar Registro</button>
            </div>
        </form>
    </div>
</div>
