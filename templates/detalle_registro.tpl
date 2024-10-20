{include file='header.tpl'}

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light text-dark">
            <h1 class="card-title">Detalles del Registro</h1>
            <h3 class="list-group-item"><strong>Establecimiento:</strong> {if $establecimiento->nombre}{$establecimiento->nombre|escape}{else}No disponible{/if}</h3>
        </div>
        <div class="card-body">
            {if $registro->nombre}
                <div class="row">
                    <div class="col-md-4">
                        <!-- Imagen del establecimiento -->
                        {if $establecimiento->imagen}
                            <img src="{$BASE_URL}{$establecimiento->imagen|escape}" class="card-img-top img-fluid rounded" alt="Imagen de {$establecimiento->nombre|escape}">
                        {else}
                            <p>No image available.</p>
                        {/if}
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nombre:</strong> {$registro->nombre|escape}
                            </li>
                            <li class="list-group-item">
                                <strong>Accion:</strong> {$registro->action|escape}
                            </li>
                            <li class="list-group-item">
                                <strong>Fecha:</strong> {$registro->fecha|date_format:"%d/%m/%Y"}
                            </li>
                            <li class="list-group-item">
                                <strong>Hora:</strong> {$registro->hora|date_format:"%H:%M"}
                            </li>
                            <li class="list-group-item">
                                <strong>Dirección:</strong> {if $establecimiento->direccion}{$establecimiento->direccion|escape}, {$establecimiento->ciudad|escape}{else}No disponible{/if}
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