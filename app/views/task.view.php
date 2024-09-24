<?php

class TaskView {
    public function showTasks($tasks) {
        require './templates/header.php';
        require './templates/form_alta.php';
        ?>
    
        <ul class="list-group">
        <?php foreach($tasks as $task) { ?>
            <li class="list-group-item item-task <?php if ($task->finalizada) echo 'finished'; ?>">
                <div class="label">
                    <b><?= $task->titulo ?></b> | (Prioridad <?= $task->prioridad ?>)
                </div>
                <div class="actions">
                    <?php if(!$task->finalizada) { ?> <a href="finalizar/<?= $task->id ?>" class='btn btn-sm btn-success ml-auto'>FINALIZAR</a> <?php } ?>
                    <a class="btn btn-sm btn-danger" href="eliminar/<?= $task->id ?>">ELIMINAR</a>
                </div>
            </li>
        <?php }
    
        require './templates/footer.php';
    }

    public function showError($error) {
        require './templates/header.php';
        echo "<h1>Error: $error</h1>";
        require './templates/footer.php';
    }
}