{include file='header.tpl'}
{include file='form_alta_establecimiento.tpl'}

<div class="container mt-4">
    <h2>Establecimientos</h2>
    
    <ul class="list-group">
        {foreach from=$establecimientos item=establecimiento}
            <li class="list-group-item item-registro">
                <div class="label">
                    <b>{$establecimiento->nombre|escape}</b> | 
                    ciudad {$establecimiento->ciudad|escape}
                </div>
            </li>
        {/foreach}
    </ul>

</div>

{include file='footer.tpl'}
