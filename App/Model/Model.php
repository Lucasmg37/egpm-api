<?php

namespace App\Model;

use Exception;
use PDOStatement;
use PDO;

Class Model
{

    /**
     * @var Banco
     */
    public $banco;
    public $bd;
    public $primary;
    public $request;
    public $configsFile;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->bd = Banco::getConection();
        $this->request = new Request();
    }

    /**
     * @param $retorno PDOStatement
     * @return mixed
     * @deprecated
     */
    public function trataRetornoAllArray($retorno)
    {
        $result = $retorno->fetchAll(PDO::FETCH_ASSOC);
        $array["data"] = $result;
        $array["status"] = true;

        return $array;
    }

    /**
     * @param $bd PDO
     * @param $sql
     * @param null $parameters
     * @return mixed
     * @throws Exception
     */
    public static function executeSource($bd, $sql, $parameters = null)
    {
        $execute = $bd->prepare($sql);
        $ok = $execute->execute($parameters);

        if (!$ok) {
            throw new Exception($execute->errorInfo()[2]);
        }

        return $execute->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $message
     * @param string $type
     * @param int $code
     * @param null $data
     * @deprecated
     */
    public static function failJson($message, $type = "error", $code = 202, $data = null)
    {

        header('HTTP/1.1 400 Bad Request');

        if ($data) {
            $array["erro"]["data"] = $data;
        }

        $array["erro"]["message"] = $message;
        $array["erro"]["type"] = $type;
        $array["erro"]["code"] = $code;
        $array["status"] = false;
        echo json_encode($array);
        exit;
    }

    /**
     * @param $Exeption Exception
     * @deprecated
     */
    public static function lancaErro($Exeption)
    {
        header('HTTP/1.1 400 Bad Request');

        $erro["erro"]["type"] = "error";
        $erro["status"] = false;
        $erro["erro"]["message"] = $Exeption->getMessage();
        $erro["erro"]["code"] = $Exeption->getCode();
        echo json_encode($erro);
        exit;
    }

    /**
     * Retorna Data Atual
     * @return false|string
     */
    public static function now()
    {
        $data = date("Y-m-d");
        return $data;
    }

    /**
     * Retorna DateTime atual
     * @return string
     */
    public static function nowTime()
    {
        $data = date("Y-m-d H:i:s");
        return $data;
    }

    /**
     * Retorna hora atual
     * @return false|string
     */
    public static function time()
    {
        $data = date("H:i:s");
        return $data;
    }

    /**
     * @param $valor
     * @return string
     * @deprecated
     */
    public function criptografa($valor)
    {
        $cod = "sha256";
        $chave = $this->nowTime();
        return hash($cod, $chave . $valor);
    }

    /**
     * @param $data1
     * @param $data2
     * @return false|int
     */
    public function subtrairDatas($data1, $data2)
    {
        $data1 = date($data1);
        $data2 = date($data2);
        $data1 = strtotime($data1);
        $data2 = strtotime($data2);

        return $data1 - $data2;

    }

    /**
     * @return Banco
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * @return bool
     */
    public function rollBack()
    {
        $this->bd->rollBack();
        return true;
    }

    /**
     * @return bool
     */
    public function beginTransaction()
    {
        $this->bd->beginTransaction();
        return true;
    }

    /**
     * @return bool
     */
    public function commit()
    {
        $this->bd->commit();
        return true;
    }

}