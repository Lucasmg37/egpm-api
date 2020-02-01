<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Botao;
use Exception;

class IngressoController extends Controller
{

    /**
     * @return mixed|null
     * @throws Exception
     */
    public function getAction()
    {
        $botao = new Botao();
        return $botao->getFirst($botao->findAll());
    }

    /**
     * @return Botao
     * @throws Exception
     */
    public function putAction()
    {
        $botao = new Botao();
        $botao->setBlAtivo($this->request->getParameter("bl_ativo"));
        $botao->setStLink($this->request->getParameter("st_link"));
        $botao->setIdBotao(1);
        $botao->save();
        return $botao;

    }

}