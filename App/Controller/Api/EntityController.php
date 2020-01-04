<?php


namespace App\Controller\Api;

use App\Controller\Controller;
use App\Model\Entity\Comentario;
use App\Model\Entity\Comentarioimagem;
use App\Model\Entity\EntityGenerate;
use App\Model\Entity\Fotogaleria;
use App\Model\Entity\Fotogaleriaimagem;
use App\Model\Entity\Imagem;
use App\Model\Entity\Jogo;
use App\Model\Entity\Jogoimagem;
use App\Model\Entity\Patrocinador;
use App\Model\Entity\Patrocinadorimagem;
use App\Model\Response;
use Exception;


class EntityController extends Controller
{
    /**
     * EntityController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|bool
     */
    public function getAction()
    {
        try {
            $entityg = new EntityGenerate();
            return $entityg->generateEntity();
        } catch (Exception $e) {
            Response::exceptionResponse($e);
            return true;
        }

    }

    public function corrigirImagensAction()
    {
        $jogoEnt = new Fotogaleria();
        $jogos = $jogoEnt->findAll();

        foreach ($jogos as $jogo) {
            $jogoEnt->mount($jogo);
            $campeonatoimagem = new Fotogaleriaimagem();
            $campeonatoimagem->setIdFotogaleria($jogoEnt->getIdFotogaleria());
            $imagensjogo = $campeonatoimagem->find();

            $i = 0;
            $prefixo = ["ori", "default", "sm", "md", "lg"];
            foreach ($imagensjogo as $imagemd) {
                $imagem = new Imagem();
                $imagem->mount($imagemd);
                $imagem->findOne();
                $imagem->setStPrefixotamanho($prefixo[$i]);
                $imagem->update();
                $i++;
            }

        }


    }

}