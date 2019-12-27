<?php


namespace App\Routes;


class Entity extends Route
{

    public function __construct()
    {
        parent::__construct();
        $this->router->setAutenticated(false);
        $this->router->setOperation(["DEV"]);
    }

}