<?php


namespace App\Routes;


class Jogo extends Route
{


    public function __construct()
    {
        parent::__construct();
        $this->setNewRoute("GET", "Jogo", "getAcessos");
    }
}