<?php

class TaskView {
    public function showTasks($tasks) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($tasks);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/lista_tareas.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

}