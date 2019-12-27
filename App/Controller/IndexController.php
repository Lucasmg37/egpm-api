<?php

namespace App\Controller;

Class IndexController extends Controller
{

    /**
     * Default Action
     */
    public function renderAction()
    {
        $this->getRender()->setCaminho("Index");
        $this->getRender()->renderScreen();
    }

}