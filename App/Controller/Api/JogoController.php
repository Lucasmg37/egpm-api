<?php


namespace App\Controller\Api;


use App\Business\Imagem;
use App\Controller\Controller;
use App\Model\Entity\Acessojogo;
use App\Model\Entity\Jogo;
use App\Model\Entity\Jogoimagem;
use App\Model\Entity\VwAcessosjogos;
use App\Model\Model;
use Exception;
use Gumlet\ImageResizeException;

class JogoController extends Controller
{

    /**
     * @param $id_jogo
     * @return Jogo|mixed
     * @throws Exception
     */
    public function getAction($id_jogo)
    {
        $jogoNegocio = new \App\Business\Jogo();

        if ($id_jogo) {
            $retorno = $jogoNegocio->getOne($id_jogo);

            $acessoJogoEntity = new Acessojogo();
            $acessoJogoEntity->setIdJogo($id_jogo);
            $acessoJogoEntity->setDtAcesso(Model::now());
            $acessoJogoEntity->setDtAcessojogo(Model::nowTime());
            $acessoJogoEntity->save();

            return $retorno;

        }
        return $jogoNegocio->getAll();
    }

    /**
     * @return Jogo
     * @throws ImageResizeException|Exception
     */
    public function postAction()
    {
        if ($this->request->getParameter("id_jogo")) {
            return $this->putAction();
        }

        $arquivo = $this->request->getFile("st_file");
        $jogo = new \App\Business\Jogo();
        $jogoEntity = $jogo->insert($this->request->getAllParameters());

        if ($arquivo) {
            Imagem::vinculaImagemWithResize(
                $arquivo,
                "Jogos",
                new Jogoimagem(),
                "setIdJogo",
                $jogoEntity->getIdJogo());
        }

        return $jogoEntity;
    }

    /**
     * @param $id_jogo
     * @throws Exception
     */
    public function deleteAction($id_jogo)
    {
        try {
            $this->getModel()->beginTransaction();
            $jogo = new \App\Business\Jogo();

            Imagem::desvinculaImagensWithResize(
                new Jogoimagem(),
                "setIdJogo",
                $id_jogo);

            $jogo->deleteAllHorarios($id_jogo);
            $jogoEntity = new Jogo();
            $jogoEntity->delete($id_jogo);
            $this->getModel()->commit();

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }

    /**
     * @return Jogo|void
     * @throws ImageResizeException|Exception
     */
    public function putAction()
    {
        $arquivo = $this->request->getFile("st_file", false);
        $jogo = new \App\Business\Jogo();
        $jogoEntity = $jogo->update($this->request->getAllParameters());

        if ($arquivo) {

            Imagem::desvinculaImagensWithResize(
                new Jogoimagem(),
                "setIdJogo",
                $jogoEntity->getIdJogo());

            Imagem::vinculaImagemWithResize(
                $arquivo,
                "Jogos",
                new Jogoimagem(),
                "setIdJogo",
                $jogoEntity->getIdJogo());

        }

        return $jogoEntity;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAcessosAction()
    {
        $acesssoEntity = new VwAcessosjogos();
        return $acesssoEntity->findAll();
    }

}