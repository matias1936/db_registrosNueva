<?php
require_once 'db_task.php';

function showTasks() {
    require './templates/header.php';
    require './templates/form_alta.php';

    // obtengo las tareas de la DB
    $tasks = getTasks();
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

function addTask() {
    if (!isset($_POST['title']) || empty($_POST['title'])) {
        echo "<h1>Error: falta completar el titulo</h1>";
        return;
    }

    if (!isset($_POST['priority']) || empty($_POST['priority'])) {
        echo "<h1>Error: falta completar la prioridad</h1>";
        return;
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];

    $id = insertTask($title, $description, $priority);

    // redirijo al home
    header('Location: ' . BASE_URL);
}

function deleteTask($id) {
    // obtengo la tarea por id
    $task = getTask($id);

    if (!$task) {
        echo "<h1>No existe la tarea con el id=$id</h1>";
        return;
    }

    // borro la tarea y redirijo
    eraseTask($id);
    header('Location: ' . BASE_URL);
}


function finishTask($id) {
    $task = getTask($id);

    if (!$task) {
        echo "<h1>No existe la tarea con el id=$id</h1>";
        return;
    }

    updateTask($id);
    header('Location: ' . BASE_URL);
}


