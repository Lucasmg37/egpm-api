<?php


namespace App\Controller\Api;


use App\Business\Patrocinador;
use App\Controller\Controller;
use Exception;

class PatrocinadorController extends Controller
{

    /**
     * @return \App\Model\Entity\Patrocinador|array|void
     * @throws Exception
     */
    public function postAction()
    {
        try {

            $input = $this->request->getAllParameters();

            if ($input["id_patrocinador"]) {
                return $this->putAction();
            }

            $this->getModel()->beginTransaction();
            $arquivo = $this->request->getFile("st_file", false);

            if (!$arquivo) {
                throw new Exception("É obrigatório o envio da logo da empresa.");
            }

            $patrocinador = new Patrocinador();
            $patrocinadorEntity = $patrocinador->insert($input);

            if ($arquivo) {
                $patrocinador->vinculaImagem($arquivo, $patrocinadorEntity->getIdPatrocinador());
            }

            $this->getModel()->commit();
            return $patrocinadorEntity;

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getPatrocinadoresAction()
    {
        $patrocinador = new Patrocinador();
        return $patrocinador->getPatrocinadoresPorTipo(\App\Constants\Patrocinador::PATROCINADOR);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getRealizadoresAction()
    {
        $patrocinador = new Patrocinador();
        return $patrocinador->getPatrocinadoresPorTipo(\App\Constants\Patrocinador::REALIZADOR);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getApoiadoresAction()
    {
        $patrocinador = new Patrocinador();
        return $patrocinador->getPatrocinadoresPorTipo(\App\Constants\Patrocinador::APOIADOR);
    }

    /**
     * @param $id_patrocinador
     * @return \App\Model\Entity\Patrocinador|mixed|void
     * @throws Exception
     */
    public function getAction($id_patrocinador)
    {
        $patrocinador = new Patrocinador();

        if (!empty($id_patrocinador)) {
            return $patrocinador->getOne($id_patrocinador);
        }
        return $patrocinador->getAll();
    }

    /**
     * @return \App\Model\Entity\Patrocinador|array|bool|void
     * @throws Exception
     */
    public function putAction()
    {
        try {
            $this->getModel()->beginTransaction();

            $input = $this->request->getAllParameters();
            $arquivo = $this->request->getFile("st_file", false);

            $patrocinador = new Patrocinador();
            $patrocinadorEntity = $patrocinador->update($input);

            if ($arquivo) {
                $patrocinador->desvinculaImagens($patrocinadorEntity->getIdPatrocinador());
                $patrocinador->vinculaImagem($arquivo, $patrocinadorEntity->getIdPatrocinador());
            }

            $this->getModel()->commit();
            return $patrocinadorEntity;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw  $e;
        }
    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function deleteAction($id)
    {
        try {
            $this->getModel()->beginTransaction();

            $patrocinador = new Patrocinador();
            $patrocinador->desvinculaImagens($id);

            $patrocinadorEntity = new \App\Model\Entity\Patrocinador();
            $patrocinadorEntity->delete($id);

            $this->getModel()->commit();
            return true;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }
}
