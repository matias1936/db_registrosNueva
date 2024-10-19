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
                            <form action="verRegistro_establecimiento/{$establecimiento->id}" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="{$establecimiento->id}">
                                <button type="submit" class="btn btn-success">Ver Registros</button>
                            </form>

                            <!-- Botón de Eliminar -->
                            <form action="eliminar_establecimiento" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="{$establecimiento->id}">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
</div>

{include file='footer.tpl'}
