<?php

namespace App\Model;

use App\Constants\TipoArquivo;
use App\Util\Helper;
use App\Util\Server;
use Exception;

class File extends Model
{
    private $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNomeSave()
    {
        return $this->nomeSave;
    }

    /**
     * @param mixed $nomeSave
     */
    public function setNomeSave($nomeSave)
    {
        $this->nomeSave = $nomeSave;
    }

    /**
     * @return mixed
     */
    public function getPathSave()
    {
        return $this->pathSave;
    }

    /**
     * @param mixed $pathSave
     */
    public function setPathSave($pathSave)
    {
        $this->pathSave = $pathSave;
    }

    /**
     * @return mixed
     */
    public function getExtensao()
    {
        return $this->extensao;
    }

    /**
     * @param mixed $extensao
     */
    public function setExtensao($extensao)
    {
        $this->extensao = $extensao;
    }

    /**
     * @return mixed
     */
    public function getPathWithFile()
    {
        return $this->pathWithFile;
    }

    /**
     * @param mixed $pathWithFile
     */
    public function setPathWithFile($pathWithFile)
    {
        $this->pathWithFile = $pathWithFile;
    }

    /**
     * @return mixed
     */
    public function getUrlAcesso()
    {
        return $this->urlAcesso;
    }

    /**
     * @param mixed $urlAcesso
     */
    public function setUrlAcesso($urlAcesso)
    {
        $this->urlAcesso = $urlAcesso;
    }

    private $nome;
    private $nomeSave;
    private $pathSave;
    private $extensao;
    private $pathWithFile;
    private $urlAcesso;

    /**
     * @param $destino
     * @param $arquivo
     * @param $tipo TipoArquivo|array
     * @return $this
     * @throws Exception
     */
    public function upload($destino, $arquivo, $tipo)
    {

        if ($arquivo == null || $arquivo == "") {
            throw new Exception("Arquivo não foi enviado!");
        }

        if (!empty($arquivo["error"])) {
            throw new Exception("Ocorreu um erro no upload do arquivo!");
        }

        if (!File::verificaTipoArquivo($arquivo, $tipo)) {
            throw new Exception("Arquivo com formato inválido para a operação.");
        }

        $diretoriosave = "upload/" . $destino . "/";

        //Cria pasta se não existir
        if (!is_dir($diretoriosave)) {
            mkdir($diretoriosave, 0777, true);
        }

        $extensao = File::getExtensaoArquivo($arquivo["name"]);
        $nomeSave = Helper::criptografaWithDate();

        $save = $diretoriosave . $nomeSave . "." . $extensao;

        move_uploaded_file($arquivo['tmp_name'], $save);

        $caminhobanco = Server::getProtocol() . "://" . $_SERVER["SERVER_NAME"] . "/" . $save;

        $this->nome = $arquivo["name"];
        $this->nomeSave = $nomeSave;
        $this->file = $arquivo;
        $this->extensao = $extensao;
        $this->pathSave = $diretoriosave;
        $this->pathWithFile = $save;
        $this->urlAcesso = $caminhobanco;

        return $this;
    }

    /**
     * @param $arquivoName
     * @return string
     */
    public static function getExtensaoArquivo($arquivoName)
    {
        $invertedname = strrev($arquivoName);
        $extensao = strstr($invertedname, '.', true);
        return strrev($extensao);
    }

    /**
     * @param $arquivoName
     * @return mixed
     */
    public static function getNameWithOutExtensaoArquivo($arquivoName)
    {
        $extensao = self::getExtensaoArquivo($arquivoName);
        return str_replace("." . $extensao, "", $arquivoName);
    }

    /**
     * @param $arquivo
     * @param $tipos TipoArquivo|array
     * @return bool
     */
    public static function verificaTipoArquivo($arquivo, $tipos = array())
    {
        return in_array($arquivo["type"], $tipos);
    }

    /**
     * @param $path
     * @return string
     */
    public static function setPathFileLink($path)
    {
        return Server::getProtocol() . "://" . $_SERVER["SERVER_NAME"] . "/" . $path;
    }

    /**
     * @param $caminho
     * @return mixed
     */
    public static function getPathLink($caminho)
    {
        return str_replace(Server::getProtocol() . "://" . $_SERVER["SERVER_NAME"] . "/", "", $caminho);
    }

    /**
     * @param $st_file
     * @return bool
     * @throws Exception
     */
    public static function deletePublic($st_file)
    {
        try {
            if (empty($st_file)) {
                throw new Exception("Nome do arquivo não informado!");
            }
            //Criar caminho absoluto
            $absolutePath = $st_file;
            return unlink($absolutePath);

        } catch (Exception $e) {
            throw $e;
        }
    }

}