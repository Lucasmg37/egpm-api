<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Botao;
use Exception;

class IngressoController extends Controller
{

    /**
     * @param $id
     * @return mixed|void|null
     * @throws Exception
     */
    public function getAction($id)
    {
        $botao = new Botao();
        return $botao->mount($botao->getFirst($botao->findAll()));
    }

    /**
     * @return Botao
     * @throws Exception
     */
    public function putAction()
    {
        $botao = new Botao();

        $botao->mount($botao->getFirst($botao->findAll()));

        if ($botao->getIdBotao()) {
            $botao->setBlAtivo($this->request->getParameter("bl_ativo"));
            $botao->setStLink($this->request->getParameter("st_link"));
            $botao->save();
            return $botao;
        }

        $botao->setBlAtivo($this->request->getParameter("bl_ativo"));
        $botao->setStLink($this->request->getParameter("st_link"));
        $botao->setIdBotao(1);
        $botao->insert();
        return $botao;

    }

}