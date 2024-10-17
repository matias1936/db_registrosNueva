{include file='header.tpl'}
{include file='form_alta_registro.tpl'}

<div class="container mt-4">
    {include file='form_buscar_categoria.tpl'}
    <h2>Registros</h2>
    <ul class="list-group">
    {foreach from=$registros item=registro}
        <li class="list-group-item item-registro {if $registro->finalizada}finished{/if}">
            <div class="label">
                <b>| Nombre: {$registro->nombre|escape}</b> |
                Establecimiento: {$registro->establecimiento_nombre|escape} |
                Hora: {$registro->hora|escape} |
                Acción: {$registro->action|truncate:25} |
                (Fecha: {$registro->fecha})
            </div>
            <div class="actions">
                <a href="modificar/{$registro->id}" class="btn btn-primary btn-sm me-2">Modificar</a>
                <a href="eliminar/{$registro->id}" class="btn btn-danger btn-sm">Borrar</a>
            </div>
        </li>
    {/foreach}
</ul>


    
    
    <p class="mt-3"><small>Mostrando {$count} registros</small></p>
</div>

{include file='footer.tpl'}
