<?php


namespace App\Controller\Api;

use App\Constants\TipoArquivo;
use App\Controller\Controller;
use App\Model\Entity\Imagem;
use App\Model\Entity\Uploadimagem;
use App\Model\Validate;
use Exception;

class ImagemController extends Controller
{

    /**
     * @param $id
     * @return array|mixed|void
     * @throws Exception
     */
    public function getAction($id)
    {

        $uploadImagem = new Uploadimagem();
        $imagemObj = new Imagem();

        if (!empty($id)) {
            $uploadImagem->findOne($id);
            $imagemObj->findOne($uploadImagem->getIdImagem());
            $uploadImagem->st_url = \App\Business\Imagem::generateLinkAccess($imagemObj->getStUrl());
            return $uploadImagem;
        }

        $imagens = $uploadImagem->findAll();

        foreach ($imagens as &$imagem) {
            $imagemObj->clearObject();
            $imagemObj->mount($imagem);
            $imagemObj->findOne();

            $imagem["st_url"] = \App\Business\Imagem::generateLinkAccess($imagemObj->getStUrl());
        }

        return $imagens;
    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function deleteAction($id)
    {
        $uploadImagem = new Uploadimagem();
        $uploadImagem->findOne($id);
        $uploadImagem->delete();

        \App\Business\Imagem::deleteImage($uploadImagem->getIdImagem());
        return true;
    }

    /**
     * @return Uploadimagem|void
     * @throws Exception
     */
    public function postAction()
    {
        if (!empty($this->request->getParameter("id_uploadimagem"))) {
            return $this->putAction();
        }

        try {

            $this->getModel()->beginTransaction();

            $input = $this->request->getAllParameters();
            $st_file = $this->request->getFile("st_file");
            $this->getFile()->upload("Imagens/Geral", $st_file, TipoArquivo::TIPO_IMAGEM_DEFAULT);

            $imagem = new Imagem();
            $uploadImagem = new Uploadimagem();

            $uploadImagem->validate(Validate::UPLOAD_IMAGEM, ["INSERT"], $input);
            $uploadImagem->mount($input);

            $imagem->setStNome($uploadImagem->getStNome());
            $imagem->setStAlt($uploadImagem->getStAlt());
            $imagem->setStPrefixotamanho(\App\Constants\Imagem::PREFIXO_ORIGINAL);
            $imagem->setStUrl($this->getFile()->getUrlAcesso());
            $imagem->insert();

            $uploadImagem->setIdImagem($imagem->getIdImagem());
            $uploadImagem->insert();

            $this->getModel()->commit();
            return $uploadImagem;
        } catch (Exception $e) {
            $this->getModel()->rollBack();
            throw $e;
        }

    }

    /**
     * @return Uploadimagem|void
     * @throws Exception
     */
    public function putAction()
    {
        $uploadImagem = new Uploadimagem();
        $uploadImagem->findOne($this->request->getParameter("id_uploadimagem", true));
        $uploadImagem->setStAlt($this->request->getParameter("st_alt"));
        $uploadImagem->setStNome($this->request->getParameter("st_nome"));
        $uploadImagem->validate(Validate::UPLOAD_IMAGEM, ["UPDATE"], null, true);
        $uploadImagem->save();
        return $uploadImagem;
    }

}