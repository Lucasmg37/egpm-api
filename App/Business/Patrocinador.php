<?php


namespace App\Business;


use App\Constants\TipoArquivo;
use App\Model\Entity\Patrocinadorimagem;
use App\Model\File;
use App\Model\Validate;
use Exception;
use Gumlet\ImageResizeException;

class Patrocinador
{

    /**
     * @param $id_patrocinador
     * @return \App\Model\Entity\Patrocinador
     * @throws Exception
     */
    public function getOne($id_patrocinador)
    {
        $patrocinador = new \App\Model\Entity\Patrocinador();
        $patrocinador->findOne($id_patrocinador);
        $patrocinador->imagens = $this->getImagens($id_patrocinador);
        $patrocinador->st_imagem = Imagem::getUrlImagemPrefixo($patrocinador->imagens, "sm");
        return $patrocinador;
    }

    /**
     * @param $id_tipopatrocinador
     * @return mixed
     * @throws Exception
     */
    public function getPatrocinadoresPorTipo($id_tipopatrocinador)
    {
        $patrocinador = new \App\Model\Entity\Patrocinador();
        $patrocinador->setIdTipo($id_tipopatrocinador);
        $patrocinadores = $patrocinador->find();

        foreach ($patrocinadores as &$item) {
            $item = $this->getOne($item["id_patrocinador"]);
        }

        return $patrocinadores;

    }

    /**
     * @param $id_patrocinador
     * @return array
     * @throws Exception
     */
    public function getImagens($id_patrocinador)
    {
        $patrocinadorImagem = new Patrocinadorimagem();
        $patrocinadorImagem->setIdPatrocinador($id_patrocinador);
        $imagens = $patrocinadorImagem->find();

        $imagem = new \App\Model\Entity\Imagem();

        foreach ($imagens as &$item) {
            $imagem->clearObject();
            $imagem->mount($item);
            $item = $imagem->findOne();
        }

        return Imagem::mapeiaPorPrefixo($imagens);

    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAll()
    {

        $patrocinador = new \App\Model\Entity\Patrocinador();
        $patrocinadores = $patrocinador->findAll();

        foreach ($patrocinadores as &$item) {
            $item = $this->getOne($item["id_patrocinador"]);
        }

        return $patrocinadores;
    }

    /**
     * @param $parametros
     * @return \App\Model\Entity\Patrocinador|array
     * @throws Exception
     */
    public function insert($parametros)
    {
        $patrocinadorEntity = new \App\Model\Entity\Patrocinador();
        $patrocinadorEntity->validate(Validate::PATROCINADOR, [], $parametros, false);
        $patrocinadorEntity->mount($parametros);
        return $patrocinadorEntity->save();
    }

    /**
     * @param $parametros
     * @return \App\Model\Entity\Patrocinador|array
     * @throws Exception
     */
    public function update($parametros)
    {
        $patrocinadorEntity = new \App\Model\Entity\Patrocinador();
        $patrocinadorEntity->validate(Validate::PATROCINADOR, ["UPDATE"], $parametros, true);
        $patrocinadorEntity->mount($parametros);
        $patrocinadorEntity->save();
        return $patrocinadorEntity;
    }

    /**
     * @param $arquivo
     * @param $id_patrocinador
     * @return bool
     * @throws ImageResizeException|Exception
     */
    public function vinculaImagem($arquivo, $id_patrocinador)
    {
        $file = new File();
        $file->upload("Imagens/Patrocinador", $arquivo, TipoArquivo::TIPO_IMAGEM_DEFAULT);

        $imagemEntiy = new \App\Model\Entity\Imagem();
        $imagemEntiy->setStNome($file->getNome());
        $imagemEntiy->setStPrefixotamanho(\App\Constants\Imagem::PREFIXO_ORIGINAL);
        $imagemEntiy->setStUrl($file->getUrlAcesso());
        $imagemEntiy->insert();

        $imagemPatrocinador = new Patrocinadorimagem();
        $imagemPatrocinador->setIdImagem($imagemEntiy->getIdImagem());
        $imagemPatrocinador->setIdPatrocinador($id_patrocinador);
        $imagemPatrocinador->insert();

        $imagens = Imagem::resizeAndSave($imagemEntiy->getStUrl(), $file->getNome(), \App\Constants\Imagem::RESIZE, $file->getPathSave());

        foreach ($imagens as $image) {
            $imagemPatrocinador->clearObject();
            $imagemPatrocinador->setIdPatrocinador($id_patrocinador);
            $imagemPatrocinador->setIdImagem($image->getIdImagem());
            $imagemPatrocinador->insert();
        }

        return true;
    }

    /**
     * @param $id_patrocinador
     * @return bool
     * @throws Exception
     */
    public function desvinculaImagens($id_patrocinador)
    {
        $patrocinadorImagem = new Patrocinadorimagem();
        $patrocinadorImagem->setIdPatrocinador($id_patrocinador);
        $imagens = $patrocinadorImagem->find();

        foreach ($imagens as $imagem) {
            $patrocinadorImagem->clearObject();
            $patrocinadorImagem->mount($imagem);
            $patrocinadorImagem->delete();
            Imagem::deleteImage($imagem["id_imagem"]);
        }

        return true;
    }

}