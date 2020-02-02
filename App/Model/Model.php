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