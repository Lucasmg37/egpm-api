<?php


namespace App\Controller\Api;


use App\Business\Imagem;
use App\Controller\Controller;
use App\Business\Secao;
use App\Model\Entity\Icone;
use App\Model\Entity\Secaoimagem;
use App\Model\Validate;
use Exception;

class SecaoController extends Controller
{
    /**
     * @param $st_rota
     * @return \App\Model\Entity\Secao|\App\Model\Entity\Secao[]
     * @throws Exception
     */
    public function getAction($st_rota)
    {

        $secao = new Secao();

        if (!empty($st_rota)) {
            return $secao->getOneByRota($st_rota);
        }

        return $secao->getAll();
    }

    /**
     * @return \App\Model\Entity\Secao|void
     * @throws Exception
     */
    public function postAction()
    {
        $arquivo = $this->request->getFile("st_file", false);
        $input = $this->request->getAllParameters();

        if ($input["id_secao"]) {
            return $this->putAction();
        }

        try {
            $this->getModel()->beginTransaction();

            $secaoEntity = new \App\Model\Entity\Secao();
            $secaoEntity->validate(Validate::SECAO, [], $input);
            $secaoEntity->mount($input)->save();

            if ($arquivo) {
                Imagem::vinculaImagemWithResize($arquivo, "Secoes", new Secaoimagem(), "setIdSecao", $secaoEntity->getIdSecao());
            }

            $this->getModel()->commit();

            return $secaoEntity;

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }
    }

    /**
     * @return \App\Model\Entity\Secao|void
     * @throws Exception
     */
    public function putAction()
    {
        try {
            $arquivo = $this->request->getFile("st_file", false);
            $input = $this->request->getAllParameters();
            unset($input["st_rota"]);

            $this->getModel()->beginTransaction();

            $secaoEntity = new \App\Model\Entity\Secao();
            $secaoEntity->validate(Validate::SECAO, ["UPDATE"], $input, true);
            $secaoEntity->findOne($input["id_secao"]);
            $secaoEntity->mount($input)->save();

            if ($input["removeimagem"]) {
                Imagem::desvinculaImagensWithResize(new Secaoimagem(), "setIdSecao", $secaoEntity->getIdSecao());
            }

            if ($arquivo) {
                Imagem::desvinculaImagensWithResize(new Secaoimagem(), "setIdSecao", $secaoEntity->getIdSecao());
                Imagem::vinculaImagemWithResize($arquivo, "Secoes", new Secaoimagem(), "setIdSecao", $secaoEntity->getIdSecao());
            }

            $this->getModel()->commit();

            return $secaoEntity;

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
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
            $secaoEntity = new \App\Model\Entity\Secao();
            $secaoEntity->findOne($id);
            Imagem::desvinculaImagensWithResize(new Secaoimagem(), "setIdSecao", $secaoEntity->getIdSecao());
            $secaoEntity->delete();
            $this->getModel()->commit();

            return true;

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function salvarIconesAction()
    {
        $icones = $this->request->getAllParameters();
        $iconeEntity = new Icone();

        foreach ($icones as $icone) {
            $iconeEntity->clearObject();
            $iconeEntity->validate(Validate::ICONE, [], $icone, false);
            $iconeEntity->mount($icone);
            $iconeEntity->save();
        }

        return true;
    }
}