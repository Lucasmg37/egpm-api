<?php


namespace App\Routes;

use Exception;

class Sympla extends Route
{
    /**
     * Sympla constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->setNewRoute("GET", "Sympla", "getIntegracao", true);
        $this->setNewRoute("GET", "Sympla", "getParticipantes", true);
        $this->setNewRoute("POST", "Sympla", "limparBase", true);
        $this->setNewRoute("GET", "Sympla", "sincronizarParticiantes", true);
        $this->setNewRoute("DELETE", "Sympla", "deleteAllParticipantes", true);

    }
}