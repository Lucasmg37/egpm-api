<?php


namespace App\Business;


use App\Model\Entity\Fotogaleria;
use App\Model\Entity\Fotogaleriaimagem;
use Exception;

class Galeria
{

    /**
     * @param $id_fotoGaleria
     * @return array
     * @throws Exception
     */
    public function getImagens($id_fotoGaleria)
    {
        $fotoGaleriaImagem = new Fotogaleriaimagem();
        $imagemEntity = new \App\Model\Entity\Imagem();

        $fotoGaleriaImagem->setIdFotogaleria($id_fotoGaleria);
        $imagens = $fotoGaleriaImagem->find();

        $retorno = [];
        foreach ($imagens as $item) {
            $imagemEntity->clearObject();
            $imagemEntity->mount($item);
            $retorno[] = $imagemEntity->findOne();
        }

        return Imagem::mapeiaPorPrefixo($retorno);
    }

    /**
     * @param $id_fotoGaleria
     * @return Fotogaleria
     * @throws Exception
     */
    public function getOne($id_fotoGaleria)
    {
        $fotoGaleria = new Fotogaleria();
        $fotoGaleria->findOne($id_fotoGaleria);
        $fotoGaleria->imagens = $this->getImagens($id_fotoGaleria);
        return $fotoGaleria;

    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll()
    {

        $fotoGaleria = new Fotogaleria();
        $results = $fotoGaleria->findAll();
        $retorno = [];

        foreach ($results as $result) {
            $retorno[] = $this->getOne($result["id_fotogaleria"]);
        }

        return $retorno;

    }
}