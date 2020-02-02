<?php

namespace Bootstrap;

use App\Model\Banco;
use App\Model\Response;
use Exception;

Class Init
{
    /**
     * Função responsável por iniciar aplicação, realizando a definição de
     * rotas e a controller a ser invocada
     */
    public static function start()
    {
        try {
            $banco = new Banco();
            $_SESSION["conexaoDefault"] = $banco->getConexao();
            Router::execute(Router::begin(self::trataURI()));
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }
    }

    /**
     * Função pega a URI informada ou a rota atual, e organiza os seus parâmetros
     * conforme a lógica proposta.
     * @param null $uri
     * @return array
     */
    public static function trataURI($uri = null)
    {

        if (empty($uri) && isset($_SERVER["PATH_INFO"])) {
            $uri = $_SERVER["PATH_INFO"];
        }

        $uris = explode("/", $uri);

        $isApi = false;
        $isRender = true;
        $controller = null;

        /**
         * Variáveis irão alocar a possível ação definida na rota
         * A função de Roteamento definirá se irá utiliza-la como parâmetro ou ação da controller
         */
        $action = null;
        $parametroUnico = null;

        $parametros = [];

        //Remover primeiro indice que está vazio
        if (isset($uris[0])) {
            unset($uris[0]);
        }

        //Verificar se esta usando API
        if (isset($uris[1]) && $uris[1] === "Api") {
            $isApi = true;
            $isRender = false;
        }

        if ($isApi) {
            //Verificar se controller foi informada
            if (!empty($uris[2])) {
                $controller = $uris[2];
            }

            //Alocar valor a ação e parâmetro unico
            if (!empty($uris[3])) {
                $action = $uris[3];
                $parametroUnico = is_numeric($uris[3]) ? (int)$uris[3] : $uris[3];
            }

            //Alocar parâmetros informados na Rota
            if (!empty($uris[3])) {
                $parametros = array_slice($uris, 2);

                //Convertendo valores numéricos
                foreach ($parametros as &$parametro) {
                    $parametro = is_numeric($parametro) ? (int)$parametro : $parametro;
                }
            }
        } else {
            //Verificar se controller foi informada
            if (!empty($uris[1])) {
                $controller = $uris[1];
            }

            //Alocar valor a ação e parâmetro unico
            if (!empty($uris[2])) {
                $action = $uris[2];
                $parametroUnico = is_numeric($uris[2]) ? (int)$uris[2] : $uris[2];
            }

            //Alocar parâmetros informados na Rota
            if (!empty($uris[2])) {
                $parametros = array_slice($uris, 1);

                //Convertendo valores numéricos
                foreach ($parametros as &$parametro) {
                    $parametro = is_numeric($parametro) ? (int)$parametro : $parametro;
                }
            }
        }

        $parametrosMontados = [];
        //Chaveia os os parâmetros nome indice = Valor
        for ($i = 0; $i < sizeof($parametros); $i++) {
            //Se o nome do indice esticer vazio não será alocado
            if (!empty($parametros[$i])) {
                //Caso exista o indice, o indice do valor n~~ao exista, o valor é vazio
                if (!empty($parametros[$i + 1])) {
                    $parametrosMontados[$parametros[$i]] = is_numeric($parametros[$i + 1]) ? (int)$parametros[++$i] : $parametros[++$i];
                    continue;
                } else {
                    $parametrosMontados[$parametros[$i]] = null;
                }

            }
        }

        $retorno = [
            "parametros" => $parametros,
            "parametrosMontados" => $parametrosMontados,
            "action" => $action,
            "controller" => $controller,
            "parametroUnico" => $parametroUnico,
            "isApi" => $isApi,
            "isRender" => $isRender
        ];

        return $retorno;
    }

}
