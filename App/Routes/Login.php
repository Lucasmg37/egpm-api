<?php


namespace App\Routes;


class Login extends Route
{

    public function __construct()
    {
        parent::__construct();
        $this->router->setAutenticated(false);
        $this->setNewRoute("GET", "Login", "getStatusSessao");
    }

}