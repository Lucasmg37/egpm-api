<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Duvida;
use App\Model\Response;
use App\Model\Validate;
use Exception;

class DuvidaController extends Controller
{

    /**
     * @param $id_duvida
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_duvida)
    {
        $duvida = new Duvida();

        if (!empty($id_duvida)) {
            return $duvida->findOne($id_duvida);
        }

        return $duvida->findCustom("*", null, false, ["nu_order" => "ASC"]);
    }

    /**
     * @return Duvida|array|void
     * @throws Exception
     */
    public function postAction()
    {
        $input = $this->request->getAllParameters();

        if ($input["id_duvida"]) {
            return $this->putAction();
        }

        $duvidaEntity = new Duvida();
        $duvidaEntity->validate(Validate::DUVIDA, [], $input, false);
        $duvidaEntity->mount($input);
        return $duvidaEntity->insert();
    }

    /**
     * @return array|void
     * @throws Exception
     */
    public function putAction()
    {
        $input = $this->request->getAllParameters();
        $duvidaEntity = new Duvida();
        $duvidaEntity->validate(Validate::DUVIDA, ["UPDATE"], $input, true);
        $duvidaEntity->mount($input);
        return $duvidaEntity->update();
    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function deleteAction($id)
    {
        if (!$id) {
            Response::failResponse("O identificador da dúvida não foi enviado.");
        }

        $duvidaEntity = new Duvida();
        $duvidaEntity->delete($id);
        return true;
    }


}