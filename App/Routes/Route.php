<?php

namespace App\Routes;

use Bootstrap\Router;
use Exception;

Class Route
{

    /**
     * Route constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->router = new Router();
        $this->router->autenticated = true;
    }

    /**
     * @throws Exception
     */
    public function execute()
    {
        //Rotas personalizadas
        $this->router->setNewRoute("GET", "Index", "render", false);
        $this->router->setNewRoute("GET", "Index", "execute", false);

        $this->noAutenticate("Start", "get");
        $this->router->setNewRoute("GET", "Index", "getStatusConfiguracao", false);
        $this->router->setNewRoute("POST", "Index", "salvarConfiguracao", false);


        $this->router->setNewRoute("POST", "Secao", "salvar-icones-secao", true);
        $this->router->changeRoute("Secao", "salvar-icones-secao", "Secao", "salvarIcones");

        $this->router->setNewRoute("GET", "Agenda", "retorna-agendamentos-ativos", false);
        $this->router->changeRoute("Agenda", "retorna-agendamentos-ativos", "Agenda", "getAtivos");

        $this->router->setNewRoute("GET", "Notificacao", "get-novas-notificacoes", true);
        $this->router->changeRoute("Notificacao", "get-novas-notificacoes", "Notificacao", "getNaoVisualizadas");

        $this->router->setNewRoute("POST", "Notificacao", "visualizar", true);

        //Rotas abertas
        $this->noAutenticate("Secao", "get");
        $this->noAutenticate("Ingresso", "get");
        $this->noAutenticate("Jogo", "get");
        $this->noAutenticate("Comentario", "get");
        $this->noAutenticate("Duvida", "get");
        $this->noAutenticate("Localizacao", "get");
        $this->noAutenticate("DiaHorario", "get");
        $this->noAutenticate("Social", "get");

        $this->router->setNewRoute("GET", "Patrocinador", "getPatrocinadores", false);
        $this->router->setNewRoute("GET", "Patrocinador", "getApoiadores", false);
        $this->router->setNewRoute("GET", "Patrocinador", "getRealizadores", false);
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
     * @param $controller
     * @param $action
     * @throws Exception
     */
    public function noAutenticate($controller, $action)
    {
        $this->changeRoute($controller, $action, null, null, false);
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return $this->router;
    }

}

