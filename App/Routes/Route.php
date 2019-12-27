<?php

namespace App\Routes;

use Bootstrap\Router;
use Exception;

Class Route
{

    /**
     * Route constructor.
     */
    public function __construct()
    {
        $this->router = new Router();
        $this->router->autenticated = true;

        //Rotas personalizadas
        $this->router->setNewRoute("GET", "Index", "render", false);
        $this->router->setNewRoute("GET", "Index", "execute", false);
    }

    /**
     * Classe responsável por executar as definições criadas nas rotas
     * @var Router
     */
    public $router;

    /**
     * @param $verboHttp
     * @param $controller
     * @param $action
     * @param null $autenticated
     */
    public function setNewRoute($verboHttp, $controller, $action, $autenticated = null)
    {
        $this->router->setNewRoute($verboHttp, $controller, $action, $autenticated);
    }

    /**
     * @param $controller
     * @param $action
     * @param null $newCntroller
     * @param null $newActionl
     * @param null $autenticated
     * @throws Exception
     */
    public function changeRoute($controller, $action, $newCntroller = null, $newActionl = null, $autenticated = null)
    {
        $this->router->changeRoute($controller, $action, $newCntroller, $newActionl, $autenticated);
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return $this->router;
    }

}

