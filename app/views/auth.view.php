<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/form_login.tpl';
    }

    public function showSignup($error = '') {
        require 'templates/form_signup.tpl';
    }
}