<?php

class RegistroView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showRegistros($registros) {
        // la vista define una nueva variable con la cantida de registros
        $count = count($registros);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        require 'templates/lista_registros.phtml';

    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

}