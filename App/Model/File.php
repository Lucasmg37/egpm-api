<?php

namespace App\Model;


class File extends Model
{

    public function upload($pastaDestino, $arquivo, $tipo, $obrigatorio = true, $bl_privado = false)
    {
        try {

            if (($arquivo == null || $arquivo == "") && $obrigatorio) {
                throw new \Exception("Arquivo não foi enviado!", 400);
            }

            if (!empty($arquivo["error"])) {
                throw new \Exception("Ocorreu um erro no upload do arquivo!", 400);
            }

            if ($tipo === "image") {
                if (!($arquivo["type"] === "image/jpeg" || $arquivo["type"] === "image/jpg" || $arquivo["type"] === "image/png")) {
                    throw new \Exception("Tipo de arquivo não permitido!", 400);
                }
            }

            if ($tipo === "html") {
                if (!($arquivo["type"] === "text/html")) {
                    throw new \Exception("Tipo de arquivo não permitido!", 400);
                }
            }

            //Verifica tipo de upload
            $diretoriosave = "upload/";

            if ($bl_privado) {
                $diretoriosave = "../files/";
            }

            //Verifica se pasta de destino não está em branco
            $diretorio = $diretoriosave;

            if ($pastaDestino) {
                $diretorio = $diretoriosave . $pastaDestino . "/";
            }

            //Cria caminho completo
            $caminhoCompleto = "";
            $caminhoCompleto .= $diretorio;

            //Verifica e cria pastas para save
            if (!is_dir($diretoriosave)) {
                mkdir($diretoriosave);
            }

            if (!is_dir($caminhoCompleto)) {
                mkdir($caminhoCompleto);
            }

            //Pega Extensão do arquivo
            $invertedname = strrev($arquivo['name']);
            $extensao = strstr($invertedname, '.', true);
            $extensao = strrev($extensao);

            //Cria novo nome e adiciona extensão
            $model = new Model();
            $nameretorno = $model->criptografa(date("YmdHis"));
            $name = $nameretorno . "." . $extensao;

            $caminhoCompleto .= $name;

            //Realiza upload
            move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto); //Fazer upload do arquivo

            //Defini o caminho salvo no banco
            $caminhobanco = "http://";
            $caminhobanco .= $_SERVER["SERVER_NAME"];

            if (!$bl_privado) {
                $caminhobanco .= "/" . $caminhoCompleto;
            } else {
                $caminhobanco .= "/File/" . $nameretorno . "." . $extensao;
            }

            //Monta retorno
            $retorno["extensao"] = $extensao;
            $retorno["caminhobanco"] = $caminhobanco;
            $retorno["name"] = $nameretorno;

            return $retorno;
        } catch (\Exception $e) {
            $this->lancaErro($e);
        }
    }

    public function delete($st_file)
    {

        try {
            if (empty($st_file)) {
                throw new \Exception("Nome do arquivo não informado!");
            }
            //Criar caminho absoluto
            $absolutePath = "../files/" . $st_file;

            unlink($absolutePath);

        } catch (\Exception $e) {
            self::lancaErro($e);
        }
    }

    public function getNameFileOfUrl($url)
    {
        return str_replace("http://" . $_SERVER["SERVER_NAME"] . "/File/", "", $url);
    }


}