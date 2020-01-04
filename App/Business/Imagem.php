<?php


namespace App\Business;


use App\Model\File;
use App\Model\ResizeImage;
use App\Util\Debug;
use Gumlet\ImageResizeException;
use Exception;

class Imagem
{

    /**
     * @param $imagens array
     * @return array
     */
    public static function mapeiaPorPrefixo($imagens)
    {
        if (is_array($imagens)) {
            $retorno = [];
            foreach ($imagens as $imagen) {
                $retorno[$imagen["st_prefixotamanho"]] = $imagen;
            }

            return $retorno;
        }

        return $retorno[$imagens["st_prefixotamanho"]] = $imagens;
    }

    public static function getUrlImagemPrefixo($imagens, $st_prefixotamanho)
    {
        if (is_array($imagens)) {
            $retorno = [];
            foreach ($imagens as $imagen) {
                $retorno[$imagen["st_prefixotamanho"]] = $imagen;
            }

            return $retorno["$st_prefixotamanho"]["st_url"];
        }

        return $imagens["st_url"];
    }

    /**
     * @param $arquivo
     * @param $name
     * @param $prefixos
     * @param $pathSave
     * @param null $st_alt
     * @return \App\Model\Entity\Imagem[]
     * @throws ImageResizeException|Exception
     */
    public static function resizeAndSave($arquivo, $name, $prefixos, $pathSave, $st_alt = null)
    {
        $retorno = [];
        foreach ($prefixos as $indice => $valor) {
            $imagem = new \App\Model\Entity\Imagem();
            $imagem->clearObject();
            $imagem->setStUrl(
                ResizeImage::imageResize(
                    File::getPathLink($arquivo),
                    File::getNameWithOutExtensaoArquivo($name) . "-" . $indice . "." . File::getExtensaoArquivo($name),
                    $valor,
                    $pathSave));
            $imagem->setStNome(File::getNameWithOutExtensaoArquivo($name) . "-" . $indice . "." . File::getExtensaoArquivo($name));
            $imagem->setStPrefixotamanho($indice);
            $imagem->setStAlt($st_alt);
            $retorno[] = $imagem->save();
        }

        return $retorno;
    }

    /**
     * @param $id_imagem
     * @throws Exception
     */
    public static function deleteImage($id_imagem)
    {
        $imagem = new \App\Model\Entity\Imagem();
        $imagem->findOne($id_imagem);

        File::deletePublic(File::getPathLink($imagem->getStUrl()));
        $imagem->delete();
    }

}