<?php require 'templates/header.tpl';
?>


<div class="container mt-4">
    <h2>Establecimientos</h2>
    
    <ul class="list-group">
        <?php foreach($establecimientos as $establecimiento): ?>
            <li class="list-group-item item-registro ?>">
                <div class="label">
                    <b> <?= htmlspecialchars($establecimiento->nombre) ?></b> |
                    ciudad <?= $establecimiento->ciudad ?>
                </div>
               
            </li>
        <?php endforeach ?>
    </ul>

</div>

<?php require 'templates/footer.tpl' ?>
