{include file='header.tpl'}
{include file='form_alta_registro.tpl'}

<div class="container mt-4">
    {include file='form_buscar_categoria.tpl'}
    <h2>Registros</h2>
    <ul class="list-group">
        {foreach from=$registros item=registro}
            <li class="list-group-item mb-2 p-3 shadow-sm bg-light rounded item-registro {if $registro->finalizada}finished{/if}">
                <div class="registro-info">
                    <div class="registro-detail">
                        <span class="me-2">📝</span>
                        <strong>{$registro->nombre|escape}</strong>
                    </div>
                    <div class="registro-detail">
                        <span class="me-2">🏢</span>
                        <span>{$registro->establecimiento_nombre|escape}</span>
                    </div>
                    <div class="registro-detail">
                        <span class="me-2">🕒</span>
                        <span>{$registro->hora|escape}</span>
                    </div>
                    <div class="registro-detail">
                        <span class="me-2">🚪</span>
                        <span class="me-2">{$registro->action}</span>
                    </div>
                    <div class="registro-detail">
                        <span class="me-2">📅</span>
                        <span>{$registro->fecha}</span>
                    </div>
                </div>
                <div class="registro-actions">
                    <a href="modificar/{$registro->id}" class="btn btn-primary btn-sm me-2">Modificar</a>
                    <a href="eliminar/{$registro->id}" class="btn btn-danger btn-sm">Borrar</a>
                </div>
            </li>
        {/foreach}
    </ul>
    
    <p class="mt-3"><small>Mostrando {$count} registros</small></p>
</div>

{include file='footer.tpl'}
