<?php


namespace App\Business;


use App\Model\Entity\Datahorariocampeonato;
use App\Model\Entity\Jogoimagem;
use App\Model\Validate;
use Exception;

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