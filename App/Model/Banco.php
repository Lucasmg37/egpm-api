<?php

namespace App\Model;

use Bootstrap\Config;
use PDO;
use PDOException;
use Exception;

Class Banco
{
    private $host;
    private $bd;
    private $user;
    private $password;

    /**
     * @var $conexao PDO
     */
    public $conexao;

    /**
     * @return PDO
     */
    public function getConexao()
    {
        return $this->conexao;
    }

    /**
     * @param PDO $conexao
     */
    public function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }

    /**
     * Banco constructor.
     * @param bool $criarConexaoDefault
     * @throws Exception
     */
    public function __construct($criarConexaoDefault = true)
    {
        if ($criarConexaoDefault) {
            $config = new Config();
            $dataBanco = $config->getFirstBd();

            if (
                !empty($dataBanco["st_host"]) &&
                !empty($dataBanco["st_user"]) &&
                !empty($dataBanco["st_host"])
            ) {
                self::setHost($dataBanco["st_host"]);
                self::setBd($dataBanco["st_dbname"]);
                self::setUser($dataBanco["st_user"]);
                self::setPassword($dataBanco["st_password"]);
                self::conexaoMySql();
            }
        }
    }

    /**
     * @param $nomeBanco
     * @return bool|PDO
     * @throws Exception
     */
    public static function newConectionByConfig($nomeBanco)
    {
        $config = new Config();
        $dataBanco = $config->getBd($nomeBanco);

        $banco = new Banco();
        $banco->setHost($dataBanco["st_host"]);
        $banco->setBd($dataBanco["st_dbname"]);
        $banco->setUser($dataBanco["st_user"]);
        $banco->setPassword($dataBanco["st_password"]);

        $_SESSION["conexoes"][$dataBanco["st_host"]] = $banco->conexaoMySql();

        return true;

    }

    /**
     * @param $identificador
     * @param $st_host
     * @param $st_dbname
     * @param $st_user
     * @param $st_password
     * @return bool
     * @throws Exception
     */
    public static function newConection($identificador, $st_host, $st_dbname, $st_user, $st_password)
    {

        $banco = new Banco();
        $banco->setHost($st_host);
        $banco->setBd($st_dbname);
        $banco->setUser($st_user);
        $banco->setPassword($st_password);

        $_SESSION["conexoes"][$identificador] = $banco->conexaoMySql();

        return true;

    }


    /**
     * @param null $nome
     * @return PDO
     */
    public static function getConection($nome = null)
    {

        if (empty($nome)) {
            return $_SESSION["conexaoDefault"];
        }

        return $_SESSION["conexoes"][$nome];
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }


    /**
     * @param mixed $bd
     */
    public function setBd($bd)
    {
        $this->bd = $bd;
    }


    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return bool|PDO
     * @throws Exception
     */
    public function conexaoMySql()
    {
        try {
            $con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->bd . "", $this->user, $this->password);
            self::setConexao($con);
            return $con;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param null $identificador
     */
    public static function beginTransaction($identificador = null)
    {

        if (empty($identificador)) {
            Banco::getConection()->beginTransaction();
        } else {
            Banco::getConection($identificador)->beginTransaction();
        }

    }

    /**
     * @param null $identificador
     */
    public static function commit($identificador = null)
    {

        if (empty($identificador)) {
            Banco::getConection()->commit();
        } else {
            Banco::getConection($identificador)->commit();
        }

    }

    /**
     * @param null $identificador
     */
    public static function roolback($identificador = null)
    {

        if (empty($identificador)) {
            Banco::getConection()->rollBack();
        } else {
            Banco::getConection($identificador)->rollBack();
        }

    }

    /**
     * @return mixed
     */
    public function getBd()
    {
        return $this->bd;
    }


}

