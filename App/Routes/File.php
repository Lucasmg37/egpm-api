<?php


namespace App\Routes;



class File extends Route
{

    public function __construct()
    {
        parent::__construct();
        $this->getRouter()->autenticated = false;
    }

    public function getRoute($parametrosURI)
    {
        $parametro = implode("/", $parametrosURI["parametros"]);
        $this->getRouter()->setUnique($parametro);
        $this->getRouter()->setParameters($parametro);
        return $this->getRouter();
    }

}