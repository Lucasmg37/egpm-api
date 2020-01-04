<?php


namespace App\Business;

use App\Model\Entity\Secaoimagem;
use Exception;

class Secao
{

    /**
     * @param $st_rota
     * @return \App\Model\Entity\Secao
     * @throws Exception
     */
    public function getOneByRota($st_rota)
    {
        $secao = new \App\Model\Entity\Secao();
        $secao->setStRota($st_rota);
        $secaoSelecionada = $secao->getFirst($secao->find());
        $secao->mount($secaoSelecionada);
        $secao->imagens = $this->getImagens($secao->getIdSecao());

        return $secao;

    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll()
    {
        $secao = new \App\Model\Entity\Secao();
        $secoes = $secao->findAll();
        $retorno = [];

        foreach ($secoes as $item) {
            $secao->clearObject();
            $secao->mount($item);
            $retorno[] = self::getOneByRota($secao->getStRota());
        }

        return $retorno;
    }

    /**
     * @param $id_secao
     * @return array
     * @throws Exception
     */
    public function getImagens($id_secao)
    {
        $secaoImagem = new Secaoimagem();
        $secaoImagem->setIdSecao($id_secao);
        $imagens = $secaoImagem->find();

        $imagemEntity = new \App\Model\Entity\Imagem();

        foreach ($imagens as &$imagem) {
            $imagemEntity->clearObject();
            $imagemEntity->mount($imagem);
            $imagem = $imagemEntity->findOne();
        }

        return Imagem::mapeiaPorPrefixo($imagens);
    }

}