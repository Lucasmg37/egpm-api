<?php

namespace App\Controller\Api;

use App\Controller\Controller;
use App\Model\Response;

Class IndexController extends Controller
{

    /**
     * Default Action
     */
    public function executeAction()
    {
        Response::succesResponse("Tudo certo por aqui!");
    }

}