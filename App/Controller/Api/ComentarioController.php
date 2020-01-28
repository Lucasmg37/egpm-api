<?php


namespace App\Controller\Api;


use App\Business\Comentario;
use App\Business\Imagem;
use App\Controller\Controller;
use App\Model\Entity\Comentarioimagem;
use App\Model\Validate;
use Exception;

class ComentarioController extends Controller
{

    /**
     * @param $id_comentario
     * @return \App\Model\Entity\Comentario|mixed
     * @throws Exception
     */
    public function getAction($id_comentario)
    {
        $comentario = new Comentario();

        if (!empty($id_comentario)) {
            return $comentario->getOne($id_comentario);
        }

        return $comentario->getAll();
    }

    /**
     * @return \App\Model\Entity\Comentario|bool|void
     * @throws Exception
     */
    public function postAction()
    {
        try {

            if ($this->request->getParameter("id_comentario")) {
                return $this->putAction();
            }

            $this->getModel()->beginTransaction();

            $arquivo = $this->request->getFile("st_file", false);
            if (!$arquivo) {
                throw new Exception("É obrigatório o envio da imagem de perfil do autor");
            }

            $input = $this->request->getAllParameters();

            $comentarioEntity = new \App\Model\Entity\Comentario();
            $comentarioEntity->validate(Validate::COMENTARIO, [], $input, false);
            $comentarioEntity->mount($input)->save();

            Imagem::vinculaImagemWithResize($arquivo, "Comentarios", new Comentarioimagem(), "setIdComentario", $comentarioEntity->getIdComentario());

            $this->getModel()->commit();
            return $comentarioEntity;

        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }
    }

    /**
     * @return \App\Model\Entity\Comentario|void
     * @throws Exception
     */
    public function putAction()
    {
        try {

            $this->getModel()->beginTransaction();

            $arquivo = $this->request->getFile("st_file", false);
            $input = $this->request->getAllParameters();

            $comentarioEntity = new \App\Model\Entity\Comentario();
            $comentarioEntity->validate(Validate::COMENTARIO, [], $input, false);
            $comentarioEntity->mount($input)->save();

            if ($arquivo) {
                Imagem::desvinculaImagensWithResize(new Comentarioimagem(), "setIdComentario", $comentarioEntity->getIdComentario());
                Imagem::vinculaImagemWithResize($arquivo, "Comentarios", new Comentarioimagem(), "setIdComentario", $comentarioEntity->getIdComentario());
            }

            $this->getModel()->commit();
            return $comentarioEntity;

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
            Imagem::desvinculaImagensWithResize(new Comentarioimagem(), "setIdComentario", $id);
            $comentarioEntity = new \App\Model\Entity\Comentario();
            $comentarioEntity->delete($id);
            $this->getModel()->commit();
            return true;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }

}