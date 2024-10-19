{include file='header.tpl'}

<div class="container mt-4">
    <h2>Detalle del Registro</h2>
    <ul class="list-group">
        <li class="list-group-item">Nombre: {$registro->nombre|escape}</li>

        <!-- Agrega más detalles del registro según sea necesario -->
    </ul>
</div>

{include file='footer.tpl'}
