<?php


namespace App\Controller\Api;


use App\Controller\Controller;
use App\Model\Entity\Jogo;
use App\Util\Debug;
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
            return $jogoNegocio->getOne($id_jogo);

            //todo salvar acesso do jogo quando não estiver autenticado
//            if (!Autentication::getBearerToken()) {
//                $tb_acessojogo = new tb_acessojogoDAO(null);
//                $tb_acessojogo->id_jogo = $id;
//                $tb_acessojogo->dt_acessojogo = Model::nowTime();
//                $tb_acessojogo->dt_acesso = Model::now();
//                $tb_acessojogo->save();
//            }

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
            $jogo->vinculaImagem($arquivo, $jogoEntity->getIdJogo());
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
            $jogo->desvinculaImagens($id_jogo);
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
     * @return Jogo
     * @throws ImageResizeException
     */
    public function putAction()
    {
        $arquivo = $this->request->getFile("st_file", false);
        $jogo = new \App\Business\Jogo();
        $jogoEntity = $jogo->update($this->request->getAllParameters());

        if ($arquivo) {
            $jogo->desvinculaImagens($jogoEntity->getIdJogo());
            $jogo->vinculaImagem($arquivo, $jogoEntity->getIdJogo());
        }

        return $jogoEntity;
    }

}