<?php


namespace App\Constants;

use App\Model\Entity\Comentario;
use App\Model\Entity\Comentarioimagem;
use App\Model\Entity\Fotogaleria;
use App\Model\Entity\Fotogaleriaimagem;
use App\Model\Entity\Jogo;
use App\Model\Entity\Jogoimagem;
use App\Model\Entity\Patrocinadorimagem;
use App\Model\Entity\Secao;
use App\Model\Entity\Secaoimagem;
use Exception;

class Imagem
{
    const PREFIXO_ORIGINAL = "ori";
    const PREFIXO_DEFAULT = "default";
    const PREFIXO_SMALL = "sm";
    const PREFIXO_MEDIUM = "md";
    const PREFIXO_LARGE = "lg";

    const RESIZE = [
        self::PREFIXO_DEFAULT => 576,
        self::PREFIXO_SMALL => 768,
        self::PREFIXO_MEDIUM => 992,
        self::PREFIXO_LARGE => 1200
    ];

    const IMAGEMJOGO = 1;
    const IMAGEMCOMENTARIO = 2;
    const IMAGEMSECAO = 3;
    const IMAGEMPATROCINADOR = 4;
    const IMAGEMPERFIL = 5;
    const IMAGEMGERAL = 6;
    const IMAGEMGALERIA = 7;

    /**
     * @param $id_tipo Imagem
     * @return array|null
     * @throws Exception
     */
    public static function getClassByTipo($id_tipo)
    {
        switch ($id_tipo) {
            case self::IMAGEMJOGO:
                return [
                    "imageClass" => new Jogoimagem(),
                    "class" => new Jogo()
                ];
                break;
            case self::IMAGEMCOMENTARIO:
                return [
                    "imageClass" => new Comentarioimagem(),
                    "class" => new Comentario()
                ];
                break;
            case self::IMAGEMSECAO:
                return [
                    "imageClass" => new Secaoimagem(),
                    "class" => new Secao()
                ];
                break;
            case self::IMAGEMPATROCINADOR:
                return [
                    "imageClass" => new Patrocinadorimagem(),
                    "class" => new \App\Model\Entity\Patrocinador()
                ];
                break;
            case self::IMAGEMGALERIA:
                return [
                    "imageClass" => new Fotogaleriaimagem(),
                    "class" => new Fotogaleria()
                ];
                break;
            case self::IMAGEMGERAL:
            case self::IMAGEMPERFIL:
            default:
                return null;
        }
    }
}