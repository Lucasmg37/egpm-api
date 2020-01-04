<?php


namespace App\Routes;


class Jogo extends Route
{

    public function getRoute()
    {
        $this->router->setAutenticated(false);
        return $this->router;
    }

}