<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Apoio;
use Exception;

class ApoioController extends Controller
{

    /**
     * @return Apoio|void
     * @throws Exception
     */
    public function postAction()
    {
        $input = $this->request->getAllParameters();
        $apoio = new \App\Business\Apoio();
        return $apoio->insert($input);
    }

    /**
     * @param $id
     * @return array|mixed|void
     * @throws Exception
     */
    public function getAction($id)
    {
        $apoio = new Apoio();

        if ($id) {
            return $apoio->findOne($id);
        }
        $apoio->setBlAtivo(1);
        return $apoio->find();
    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function deleteAction($id)
    {
        $apoio = new Apoio();
        $apoio->findOne($id);
        $apoio->setBlAtivo(0);
        $apoio->save();
        return true;
    }

    /**
     * @param $id
     * @return Apoio
     * @throws Exception
     */
    public function marcarComoAnalizadoAction($id)
    {
        $apoio = new Apoio();
        $apoio->findOne($id);
        $apoio->setBlAnalisado(1);
        $apoio->save();
        return $apoio;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getNaoAnalizadosAction()
    {
        $apoioEntity = new Apoio();
        $apoioEntity->setBlAnalisado(0);
        return $apoioEntity->find();
    }

}