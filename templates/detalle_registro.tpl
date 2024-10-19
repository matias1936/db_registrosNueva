{include file='header.tpl'}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title">Detalle del Registro</h2>
        </div>
        <div class="card-body">
            {if $data.registro_nombre}
                <div class="row">
                    <div class="col-md-4">
                        <!-- Imagen del establecimiento -->
                        <p>Contenido de establecimiento_imagen: {$data.establecimiento_imagen|escape}</p>
                        <img src="app/images/{$data.establecimiento_imagen|escape}" alt="Imagen de {$data.establecimiento_nombre|escape}" class="img-fluid rounded mb-3">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nombre del Registro:</strong> {$data.registro_nombre|escape}
                            </li>
                            <li class="list-group-item">
                                <strong>Fecha de Registro:</strong> {$data.registro_fecha|date_format:"%d/%m/%Y"}
                            </li>
                            <li class="list-group-item">
                                <strong>Hora de Registro:</strong> {$data.registro_hora|date_format:"%H:%M"}
                            </li>
                            <li class="list-group-item">
                                <strong>Establecimiento:</strong> {if $data.establecimiento_nombre}{$data.establecimiento_nombre|escape}{else}No disponible{/if}
                            </li>
                            <li class="list-group-item">
                                <strong>Dirección:</strong> {if $data.establecimiento_direccion}{$data.establecimiento_direccion|escape}, {$data.establecimiento_ciudad|escape}{else}No disponible{/if}
                            </li>
                        </ul>
                    </div>
                </div>
            {else}
                <p class="text-danger">No se encontraron detalles para este registro.</p>
            {/if}
        </div>
        <div class="card-footer text-end">
            <a href="{$BASE_URL}?action=listar" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    </div>
</div>

{include file='footer.tpl'}
