{include file='header.tpl'}

<h2>Modificar Registro</h2>

<form action="{BASE_URL}modificar/{$registro->id}" method="POST">
    <label for="nombre">Nombre:</label>
     <input type="text" id="nombre" name="nombre" value="{$registro->nombre}" class="form-control"><br><br>
     
    <label for="action">Acción</label>
         <select required name="action" class="form-control" id="action">
            <option value="" disabled selected>Selecciona una acción</option>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>

     <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="{$registro->fecha}" class="form-control"><br><br>

    <label for="hora">Hora:</label>
    <input type="time" id="hora" name="hora" value="{$registro->hora}" class="form-control"><br><br>

   
    <label for="establecimiento">Establecimiento</label>
        <select required name="establecimiento_id" class="form-control" id="establecimiento">
            <option value="" disabled selected>Selecciona un establecimiento</option>
                {foreach from=$establecimientos item=establecimiento}
            <option value="{$establecimiento->id|escape}">
                {$establecimiento->nombre|escape}
            </option>
                {/foreach}
        </select>
    
                    
   
    
    
    <div class="text-center">
                <button type="submit" class="btn btn-success mt-2">Modificar</button>
    </div>
</form>

{include file='footer.tpl'}