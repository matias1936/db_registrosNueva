{include file='header.tpl'}
{include file='form_alta_establecimiento.tpl'}

<div class="container mt-4">
    <h2>Establecimientos</h2>
    <div class="row">
        {foreach from=$establecimientos item=establecimiento}
            <div class="col-md-4 mb-3">
                <div class="card item-registro">
                    <img src="{$establecimiento->imagen|escape}" class="card-img-top" alt="Imagen de {$establecimiento->nombre|escape}">
                    <div class="card-body">
                        <h5 class="card-title">{$establecimiento->nombre|escape}</h5>
                        <p class="card-text">Ciudad: {$establecimiento->ciudad|escape}</p>
                        <div class="actions">
                            <!-- Botón de Ver Registros -->
                            <a href="verRegistros/{$establecimiento->id}" class="btn btn-primary">Ver Registros</a>

                            <!-- Botón de Eliminar -->
                            <a href="eliminar_establecimiento/{$establecimiento->id}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
</div>

{include file='footer.tpl'}
