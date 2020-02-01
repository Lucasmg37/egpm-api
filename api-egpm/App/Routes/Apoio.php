<?php


namespace App\Routes;

use Exception;

class Apoio extends Route
{
    /**
     * Apoio constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->setNewRoute("POST", "Apoio", "marcarComoAnalizado", true);

        $this->setNewRoute("GET", "Apoio", "get-apoios-pendentes", true);
        $this->changeRoute("Apoio", "get-apoios-pendentes", "Apoio", "getNaoAnalizados");
    }
}