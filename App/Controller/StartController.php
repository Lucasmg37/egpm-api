<?php


namespace App\Controller;


class StartController extends Controller
{

    public function getAction($id)
    {
        $this->getRender()->setCaminho("Start");
        $this->getRender()->renderScreen();
    }


}