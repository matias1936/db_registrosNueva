<h3>Buscar por establecimiento</h3>
    <form action="buscar" method="GET" class="mb-4">
        <div class="row">
            <div class="col">
                <select name="establecimiento" class="form-control" id="establecimiento">
                    <option value="" disabled selected>Selecciona un establecimiento</option>
                    {foreach from=$establecimientos item=establecimiento}
                        <option value="{$establecimiento->id|escape}">
                            {$establecimiento->nombre|escape}
                        </option>
                    {/foreach}
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>