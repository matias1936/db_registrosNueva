<div class="container mt-4">
    <h2>Establecimientos</h2>
    
    <ul class="list-group">
        {foreach from=$establecimientos item=establecimiento}
            <li class="list-group-item item-registro">
                <div class="label">
                    <b>{$establecimiento->nombre}</b> | Ciudad: {$establecimiento->ciudad}
                </div>
            </li>
        {/foreach}
    </ul>
</div>
