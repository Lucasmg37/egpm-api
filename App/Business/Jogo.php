<?php


namespace App\Business;


use App\Constants\TipoArquivo;
use App\Model\Entity\Datahorariocampeonato;
use App\Model\Entity\Jogoimagem;
use App\Model\File;
use App\Model\Validate;
use Exception;
use Gumlet\ImageResizeException;

class Jogo
{
    private $dataHorario;
    private $imagemJogo;
    private $imagem;
    private $jogo;

    public function __construct()
    {
        $this->dataHorario = new Datahorariocampeonato();
        $this->imagemJogo = new Jogoimagem();
        $this->imagem = new \App\Model\Entity\Imagem();
        $this->jogo = new \App\Model\Entity\Jogo();
    }

    /**
     * @param $id_jogo
     * @return mixed
     * @throws Exception
     */
    public function getHorarios($id_jogo)
    {

        $this->dataHorario->clearObject();
        $this->dataHorario->setIdJogo($id_jogo);
        return $this->dataHorario->find();

    }

    /**
     * @param $id_jogo
     * @return array
     * @throws Exception
     */
    public function getImagens($id_jogo)
    {
        $this->imagemJogo->setIdJogo($id_jogo);
        $imagensjogo = $this->imagemJogo->find();

        $retorno = [];
        foreach ($imagensjogo as $item) {
            $this->imagem->clearObject();
            $this->imagem->mount($item);
            $retorno[] = $this->imagem->findOne();
        }

        return Imagem::mapeiaPorPrefixo($retorno);

    }

    /**
     * @param $id_jogo
     * @return \App\Model\Entity\Jogo
     * @throws Exception
     */
    public function getOne($id_jogo)
    {
        $jogoEntity = new \App\Model\Entity\Jogo();
        $jogoEntity->findOne($id_jogo);
        $jogoEntity->datahorario = self::getHorarios($id_jogo);
        $jogoEntity->imagens = self::getImagens($id_jogo);
        return $jogoEntity;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll()
    {
        $this->jogo->clearObject();
        $jogos = $this->jogo->findAll();
        $retorno = [];

        foreach ($jogos as $jogo) {
            $retorno[] = $this->getOne($jogo["id_jogo"]);
        }

        return $retorno;
    }

    /**
     * @param $parameters
     * @return \App\Model\Entity\Jogo
     * @throws Exception
     */
    public function insert($parameters)
    {
        $jogo = new \App\Model\Entity\Jogo();
        $jogo->validate(Validate::JOGO, null, $parameters, false, true);
        $jogo->mount($parameters);
        return $jogo->insert();
    }

    /**
     * @param $parameters
     * @return \App\Model\Entity\Jogo
     * @throws Exception
     */
    public function update($parameters)
    {
        $jogo = new \App\Model\Entity\Jogo();
        $jogo->validate(Validate::JOGO, "UPDATE", $parameters, true, true);
        $jogo->mount($parameters);
        $jogo->update();
        return $jogo;
    }

    /**
     * @param $arquivo
     * @param $id_jogo
     * @return bool
     * @throws ImageResizeException|Exception
     */
    public function vinculaImagem($arquivo, $id_jogo)
    {
        $file = new File();
        $file->upload("Imagens/Campeonato", $arquivo, TipoArquivo::TIPO_IMAGEM_DEFAULT);

        $imagemEntiy = new \App\Model\Entity\Imagem();
        $imagemEntiy->setStNome($file->getNome());
        $imagemEntiy->setStPrefixotamanho(\App\Constants\Imagem::PREFIXO_ORIGINAL);
        $imagemEntiy->setStUrl($file->getUrlAcesso());
        $imagemEntiy->insert();

        $imagemjogo = new Jogoimagem();
        $imagemjogo->setIdImagem($imagemEntiy->getIdImagem());
        $imagemjogo->setIdJogo($id_jogo);
        $imagemjogo->insert();

        $imagens = Imagem::resizeAndSave($imagemEntiy->getStUrl(), $file->getNome(), \App\Constants\Imagem::RESIZE, $file->getPathSave());

        foreach ($imagens as $image) {
            $imagemjogo->clearObject();
            $imagemjogo->setIdJogo($id_jogo);
            $imagemjogo->setIdImagem($image->getIdImagem());
            $imagemjogo->insert();
        }

        return true;
    }

    /**
     * @param $id_jogo
     * @return bool
     * @throws Exception
     */
    public function desvinculaImagens($id_jogo)
    {
        $jogoImagem = new Jogoimagem();
        $jogoImagem->setIdJogo($id_jogo);
        $imagens = $jogoImagem->find();

        foreach ($imagens as $imagem) {
            $jogoImagem->clearObject();
            $jogoImagem->mount($imagem);
            $jogoImagem->delete();
            Imagem::deleteImage($imagem["id_imagem"]);
        }

        return true;
    }

    /**
     * @param $id_jogo
     * @return bool
     * @throws Exception
     */
    public function deleteAllHorarios($id_jogo)
    {
        $dataHorario = new Datahorariocampeonato();
        $dataHorario->setIdJogo($id_jogo);
        $results = $dataHorario->find();

        foreach ($results as $result) {
            $dataHorario->mount($result);
            $dataHorario->delete();
        }

        return true;
    }
}