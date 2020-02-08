<?php


namespace App\Business;


use App\Constants\TipoArquivo;
use App\Model\Entity\Comentarioimagem;
use App\Model\Entity\Fotogaleriaimagem;
use App\Model\Entity\Jogoimagem;
use App\Model\Entity\Patrocinadorimagem;
use App\Model\Entity\Secaoimagem;
use App\Model\File;
use App\Model\ResizeImage;
use App\Util\Server;
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

    /**
     * @param $imagens
     * @param $st_prefixotamanho
     * @return mixed
     */
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
                    80,
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
        try {
            $imagem = new \App\Model\Entity\Imagem();
            $imagem->findOne($id_imagem);

            File::deletePublic(File::getPathLink($imagem->getStUrl()));
            $imagem->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $arquivo
     * @param $classeImagem Jogoimagem|Comentarioimagem|Fotogaleriaimagem|Patrocinadorimagem|Secaoimagem Classe de ligação entre Informações e imagens
     * @param $setEntity string Set da informação de busca setIdJogo
     * @param $valueSet int Valor do atributo a ser utilizado no Set
     * @param $pathSave string Pasta para salvar imagens
     * @return bool
     * @throws ImageResizeException|Exception
     */
    public static function vinculaImagemWithResize($arquivo, $pathSave, $classeImagem, $setEntity, $valueSet)
    {
        $file = new File();
        $file->upload("Imagens/$pathSave", $arquivo, TipoArquivo::TIPO_IMAGEM_DEFAULT);

        if (!method_exists($classeImagem, $setEntity)) {
            throw new Exception("O Set informado não existe no objeto enviado!");
        }

        //Salva a imagem original
        $imagemEntiy = new \App\Model\Entity\Imagem();
        $imagemEntiy->setStNome($file->getNome());
        $imagemEntiy->setStPrefixotamanho(\App\Constants\Imagem::PREFIXO_ORIGINAL);
        $imagemEntiy->setStUrl($file->getUrlAcesso());
        $imagemEntiy->insert();

        //Vincular imagem a classe específicada
        $classeImagem->setIdImagem($imagemEntiy->getIdImagem());
        $classeImagem->$setEntity($valueSet);
        $classeImagem->insert();

        $nomeCompletoArquivo = $file->getNomeSave() . "." . $file->getExtensao();

        $imagens = Imagem::resizeAndSave($imagemEntiy->getStUrl(), $nomeCompletoArquivo, \App\Constants\Imagem::RESIZE, $file->getPathSave());

        foreach ($imagens as $image) {
            $classeImagem->clearObject();
            $classeImagem->$setEntity($valueSet);
            $classeImagem->setIdImagem($image->getIdImagem());
            $classeImagem->insert();
        }

        return true;
    }

    /**
     * @param $classeImagem Jogoimagem|Comentarioimagem|Fotogaleriaimagem|Patrocinadorimagem|Secaoimagem Classe de ligação entre Informações e imagens
     * @param $setEntity string Set da informação de busca setIdJogo
     * @param $valueSet int Valor do atributo a ser utilizado no Set
     * @return bool
     * @throws Exception
     */
    public static function desvinculaImagensWithResize($classeImagem, $setEntity, $valueSet)
    {

        if (!method_exists($classeImagem, $setEntity)) {
            throw new Exception("O Set informado não existe no objeto enviado!");
        }

        $classeImagem->$setEntity($valueSet);
        $imagens = $classeImagem->find();

        foreach ($imagens as $imagem) {
            $classeImagem->clearObject();
            $classeImagem->mount($imagem);
            $classeImagem->delete();
            Imagem::deleteImage($imagem["id_imagem"]);
        }

        return true;
    }

}