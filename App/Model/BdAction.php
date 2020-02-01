<?php


namespace App\Model;

use App\Util\DocsTools;
use ReflectionException;
use Exception;
use ReflectionClass;
use ReflectionProperty;
use PDOStatement;
use PDOException;
use PDO;

class BdAction
{

    private $dataBdAction = [];

    /**
     * BdAction constructor.
     * @param $filho
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($filho, $parameters = null)
    {
        try {
            $this->dataBdAction["model"] = new Model();

            $this->dataBdAction["objFilho"] = $filho;
            $classeName = get_class($filho);
            $this->dataBdAction["atributos"] = get_class_vars($classeName);
            unset($this->dataBdAction["atributos"]["dataBdAction"]);

            $this->getDocsClasse($classeName);
            $this->getDocsAtribute($classeName);

            if ($parameters) {
                $this->mount($parameters);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * **************************************************************************************************************
     */

    /**
     * Retorna todas as linhas de uma tabela
     * @return mixed
     * @throws Exception
     */
    public function findAll()
    {
        $sql = "SELECT * FROM " . $this->getTabela();
        return $this->getResult($this->execute($sql));
    }

    /**
     * Busca valor pela Primary Key
     * @param null $value_primary_key
     * @return array
     * @throws Exception
     */
    public function findOne($value_primary_key = null)
    {
        if (!$value_primary_key) {
            $value_primary_key = $this->getValuePrimayKey();
        }

        if (empty($value_primary_key)) {
            throw new Exception("Primary key não informada!");
        }

        $sql = "SELECT * FROM " . $this->getTabela() . " WHERE " . $this->getPrimaryKey() . " = " . $value_primary_key;
        $result = $this->getOne($this->execute($sql));
        $this->mount($result);
        return $result;
    }

    /**
     * Deleta linha pela Primary Key
     * @param null $value_primary_key
     * @return bool
     * @throws Exception
     */
    public function delete($value_primary_key = null)
    {
        if (!$value_primary_key) {
            $value_primary_key = $this->getValuePrimayKey();
        }

        if (empty($value_primary_key)) {
            throw new Exception("Primary key não informada!");
        }

        //Verificar se a entrada existe
        $retorno = $this->findOne($value_primary_key);

        if (!is_array($retorno)) {
            throw new Exception("Nada encontrado!");
        }

        $sql = "DELETE FROM " . $this->getTabela() . " WHERE " . $this->getPrimaryKey() . " = " . $value_primary_key;
        $this->execute($sql);
        return true;

    }

    /**
     * Insere uma nova linha no banco
     * @return $this
     * @throws Exception
     */
    public function insert()
    {
        $parameters = $this->generateBindValues();
        $valuesInsert = $this->generateValuesInsert($parameters);

        $sql = "INSERT INTO " . $this->getTabela() . " " . $valuesInsert["fields"] . " VALUES " . $valuesInsert["values"];
        $this->execute($sql, $parameters);
        $this->clearObject();
        $this->findOne($this->isPrimaryKeyAutoIncrement() ? $this->getModel()->bd->lastInsertId() : $parameters[$this->getPrimaryKey()]);
        return $this;

    }

    /**
     * Deleta todas as linhas da tabela
     * @return bool|PDOStatement
     * @throws Exception]
     */
    public function deleteAllData()
    {
        $sql = "DELETE FROM " . $this->getTabela();
        return $this->execute($sql);
    }

    /**
     * Altera uma linha
     * @param null $value_primary_key
     * @return array
     * @throws Exception
     */
    public function update($value_primary_key = null)
    {

        if (!$value_primary_key) {
            $value_primary_key = $this->getValuePrimayKey();
        }

        if (empty($value_primary_key)) {
            throw new Exception("Primary key não informada!");
        }

        $parameters = $this->generateBindValues();
        $sets = $this->generateSetUpdate($parameters);

        $sql = "UPDATE " . $this->getTabela() . " SET " . $sets . " WHERE " . $this->getPrimaryKey() . " = " . $value_primary_key;

        $this->execute($sql, $parameters);
        return $this->findOne($value_primary_key);

    }

    /**
     * Defini automaticamente qual ação chamar
     * @return BdAction|array
     * @throws Exception
     */
    public function save()
    {
        if (!$this->getValuePrimayKey()) {
            return $this->insert();
        }

        return $this->update();

    }


    /**
     * Busca dados de acordo com o objeto montado
     * @param null $parameters
     * @return mixed
     * @throws Exception
     */
    public function find($parameters = null)
    {
        if ($parameters) {
            $this->mount($parameters);
        }

        $parameters = $this->generateBindValues();
        $where = $this->generateWhereBind($parameters);

        $sql = "SELECT * FROM " . $this->getTabela() . " WHERE " . $where;
        $result = $this->getResult($this->execute($sql, $parameters));
        return $result;
    }

    /**
     * @param string $select
     * @param array $where [nome atributo => Constante Where]
     * @param bool $distinct
     * @param array $order [nome atributo => ASC | DESC]
     * @param null $limit
     * @param null $parameters Parâmetros do objeto
     * @return mixed
     * @throws Exception
     */
    public function findCustom($select = "*", $where = array(), $distinct = false, $order = array(), $limit = null, $parameters = null)
    {
        if ($parameters) {
            $this->mount($parameters);
        }

        $select = $select === "" ? "*" : $select;
        $distinct = $distinct ? " DISTINCT " : "";
        $limit = $limit !== null ? "LIMIT " . $limit : "";

        if (sizeof($order) > 0 && is_array($order)) {
            $newOrder = [];
            foreach ($order as $key => $value) {
                $newOrder[] = $key . " " . $value;
            }

            $order = "ORDER BY " . implode(" , ", $newOrder);
        } else {
            $order = "";
        }

        $where = $this->generateWhereCustom($where);
        $parameters = $where["parameters"];


        $sql[] = "SELECT $distinct  $select";
        $sql[] = "FROM " . $this->getTabela();
        $sql[] = "WHERE " . $where["where"];
        $sql[] = $order;
        $sql[] = $limit;

        $sql = implode(" ", $sql);

        $result = $this->getResult($this->execute($sql, $parameters));
        return $result;
    }

    /**
     * @param string $select
     * @param array $where [nome atributo => Constante Where]
     * @param bool $distinct
     * @param array $order [nome atributo => ASC | DESC]
     * @param null $limit
     * @param null $parameters Parâmetros do objeto
     * @return mixed
     * @throws Exception
     */
    public function findCustomReference($select = "*", $where = array(), $distinct = false, $order = array(), $limit = null, $parameters = null)
    {
        $data = $this->findCustom($select, $where, $distinct, $order, $limit, $parameters);
        return $this->getReferencesArray($data);
    }

    /**
     * @param null $value_primary_key
     * @return $this
     * @throws Exception
     */
    public function findOneReference($value_primary_key = null)
    {
        $this->getReference($this->findOne($value_primary_key));
        return $this;
    }

    /** Find All por referência
     * @return mixed
     * @throws Exception
     */
    public function findAllReference()
    {
        $all = $this->findAll();
        return $this->getReferencesArray($all);
    }

    /**
     * @param null $parameters
     * @return mixed
     * @throws Exception
     */
    public function findReference($parameters = null)
    {
        $data = $this->find($parameters);
        return $this->getReferencesArray($data);
    }

    /**
     * @param $validate
     * @param array $seletors
     * @param null $params
     * @param bool $validaPrimaKey
     * @param bool $lancaErro
     * @return bool
     * @throws Exception
     */
    public function validate($validate, $seletors = array(), $params = null, $validaPrimaKey = false, $lancaErro = true)
    {
        try {

            $atributosaValidar = [];

            //Pegar parâmetros Globais
            foreach (Validate::GLOBAL as $key => $value) {
                $atributosaValidar[$key] = $value;
            }

            //Pegar os parâmetros globais especificos
            foreach ($validate["GLOBAL"] as $key => $value) {
                $atributosaValidar[$key] = $value;
            }

            if (is_array($seletors) && sizeof($seletors) > 0) {
                foreach ($seletors as $seletor) {
                    foreach ($validate["$seletor"] as $key => $value) {
                        $atributosaValidar[$key] = $value;
                    }
                }
            }

            //Pegar os parâmetros obrigatórios da Classe
            $requireds = $this->dataBdAction["required"];

            if ($validaPrimaKey) {
                $requireds[] = $this->getPrimaryKey();
            }

            //Realizar validação
            foreach ($requireds as $required) {
                if ($params[$required] === null || $params[$required] === "") {
                    $message = $atributosaValidar[$required];

                    if (empty($message)) {
                        $message = Validate::DEFAULT_MESSAGE;
                    }

                    if (empty($message)) {
                        $message = "O parâmetro $required é obrigatório!";
                    }

                    throw new Exception($message);
                }
            }

            return true;
        } catch (Exception $exception) {
            if ($lancaErro) {
                throw $exception;
            }

            return false;
        }
    }

    /**
     * **************************************************************************************************************
     */
    /**
     * @param $array
     * @return mixed
     * @throws Exception
     */
    private function getReferencesArray($array)
    {
        foreach ($array as &$item) {
            $this->getReference($item);
            $item = $this;
        }
        return $array;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function clearObject()
    {
        try {
            $atributes = $this->getAllAtributes();
            foreach ($atributes as $atr => $value) {
                $this->setValueAtribute($atr, null);
                $this->getFilho()->$atr = null;
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * @param $atributos
     * @throws Exception
     */
    private function getReference($atributos)
    {
        $this->clearObject();
        $this->mount($atributos);
        $foreKeys = $this->getForeignKeys();

        foreach ($foreKeys as $attr => $array) {
            $valuePrimary = $this->$attr;
            $nameClasse = "\App\Model\Entity\\" . $this->getNameClasse($array["table"]);

            /**
             * @var $obj BdAction
             */
            $obj = new  $nameClasse();
            $resultObj = $obj->findOneReference($valuePrimary);
            $this->$attr = $resultObj;

        }

    }

    /**
     * @param $table
     * @return bool|string
     */
    private function getNameClasse($table)
    {
        $name = substr($table, 3);
        $name = ucfirst($name);
        return $name;
    }

    /**
     * @param $array
     * @return mixed|null
     */
    public function getFirst($array)
    {
        if (isset($array[0])) {
            return $array[0];
        } else {
            return null;
        }
    }

    /**
     * @return mixed
     */
    private function getForeignKeys()
    {
        return $this->dataBdAction["foreign_key"];
    }

    /**
     * @param $arrayWhere ["nome atibuto" => Constante Where]
     * @return array
     */
    private function generateWhereCustom($arrayWhere)
    {
        $where = [];
        $parameter = [];
        foreach ($arrayWhere as $key => $value) {
            switch ($value) {
                case \App\Constants\System\BdAction::WHERE_LIKE :
                case \App\Constants\System\BdAction::WHERE_LIKE_L :
                case \App\Constants\System\BdAction::WHERE_LIKE_R :
                    if ($value === \App\Constants\System\BdAction::WHERE_LIKE) {
                        $where[] = $key . " " . \App\Constants\System\BdAction::WHERE_LIKE . " :$key";
                        $parameter[$key] = "%" . $this->getFilho()->$key . "%";
                    }

                    if ($value === \App\Constants\System\BdAction::WHERE_LIKE_L) {
                        $where[] = $key . " " . \App\Constants\System\BdAction::WHERE_LIKE . " :$key'";
                        $parameter[$key] = "%" . $this->getFilho()->$key;
                    }

                    if ($value === \App\Constants\System\BdAction::WHERE_LIKE_R) {
                        $where[] = $key . " " . \App\Constants\System\BdAction::WHERE_LIKE . " :$key";
                        $parameter[$key] = $this->getFilho()->$key . "%";
                    }

                    break;

                case \App\Constants\System\BdAction::WHERE_BIGGER:
                case \App\Constants\System\BdAction::WHERE_BIGGER_EQUAL:
                case \App\Constants\System\BdAction::WHERE_EQUAL:
                case \App\Constants\System\BdAction::WHERE_LESS:
                case \App\Constants\System\BdAction::WHERE_LESS_EQUAL:
                    $where[] = $key . " " . $value . " :$key";
                    $parameter[$key] = $this->getFilho()->$key;
                    break;
            }
        }

        return [
            "where" => implode(" AND ", $where),
            "parameters" => $parameter
        ];
    }

    /**
     * @param null $parameters
     * @return string
     */
    private function generateWhereBind($parameters = null)
    {
        if (!$parameters) {
            $parameters = $this->generateBindValues();
        }

        $keys = [];
        foreach ($parameters as $key => $value) {
            $keys[] = $key . " = :$key";
        }

        $where = implode(" AND ", $keys);

        return $where;
    }

    /**
     * @param null $parameters
     * @return string
     */
    private function generateSetUpdate($parameters = null)
    {
        if (!$parameters) {
            $parameters = $this->generateBindValues();
        }

        $keys = [];

        foreach ($parameters as $key => $value) {
            $keys[] = $key . " = :$key";
        }

        return implode(" , ", $keys);
    }

    /**
     * @param null $parameters
     * @return array
     */
    private function generateValuesInsert($parameters = null)
    {

        if (!$parameters) {
            $parameters = $this->generateBindValues();
        }

        $keys = [];

        foreach ($parameters as $key => &$value) {
            $keys[] = $key;
            $value = ":$key";
        }

        $fields = "( " . implode(" , ", $keys) . " )";
        $values = "( " . implode(" , ", $parameters) . " )";

        return [
            "fields" => $fields,
            "values" => $values
        ];

    }

    /**
     * @param null $values
     * @return array
     */
    private function generateBindValues($values = null)
    {

        if ($values) {
            $this->mount($values);
        }

        $parameters = [];

        foreach ($this->getAllAtributes() as $attr => $value) {
            $valor = $this->getFilho()->$attr;

            if ($valor !== null && $valor !== "") {
                $parameters[$attr] = $valor;
            }

        }
        return $parameters;
    }

    /**
     * @return BdAction
     */
    private function getFilho()
    {
        return $this->dataBdAction["objFilho"];
    }

    /**
     * @param $atributes array
     */
    public function mount($atributes)
    {
        foreach ($atributes as $attr => $value) {
            if ($this->existsAtribute($attr)) {
                $this->getFilho()->$attr = $value;
                $this->setValueAtribute($attr, $value);
            }
        }

    }

    /**
     * @param $atribute
     * @return bool
     */
    private function existsAtribute($atribute)
    {
        if (array_key_exists($atribute, $this->getAllAtributes())) {
            return true;
        }
        return false;
    }

    /**
     * @param $filho BdAction
     */
    public function atualizaAtributos($filho)
    {
        foreach ($this->getAllAtributes() as $attr => $value) {
            $this->setValueAtribute($attr, $filho->$attr);
        }

        $this->mount($this->getAllAtributes());
    }

    /**
     * @return mixed
     */
    private function getPrimaryKey()
    {
        return $this->dataBdAction["primary_key"];
    }

    /**
     * @return mixed
     */
    private function getValuePrimayKey()
    {
        return $this->getValueAtribute($this->getPrimaryKey());
    }

    /**
     * @param $nameAtribute
     * @return mixed
     */
    private function getValueAtribute($nameAtribute)
    {
        return $this->dataBdAction["atributos"][$nameAtribute];
    }

    /**
     * @param $nameAtribute
     * @param $value
     */
    private function setValueAtribute($nameAtribute, $value)
    {
        $this->dataBdAction["atributos"][$nameAtribute] = $value;
    }


    /**
     * @param $classeName
     * @throws ReflectionException
     */
    private function getDocsAtribute($classeName)
    {
        $docs = [];
        foreach ($this->dataBdAction["atributos"] as $key => $value) {
            $prop = new ReflectionProperty($classeName, $key);
            $docs[$key] = $prop->getDocComment();
        }

        $this->dataBdAction["primary_key"] = $this->getPrimaryKeyDoc($docs);
        $this->dataBdAction["foreign_key"] = $this->getForeignKeysDoc($docs);
        $this->dataBdAction["required"] = $this->getRequiredsDoc($docs);

    }

    /**
     * @return mixed
     */
    private function getAllAtributes()
    {
        return $this->dataBdAction["atributos"];
    }

    /**
     * @param $docs
     * @return int|string|null
     */
    private function getPrimaryKeyDoc($docs)
    {
        foreach ($this->dataBdAction["atributos"] as $key => $value) {

            //Tratar DOCS
            $arrayDocs = DocsTools::docsToArray($docs[$key]);
            if (DocsTools::isExistsParameter("primary_key", $arrayDocs)) {
                return $key;
            }

        }

        return null;
    }

    /**
     * @param $docs
     * @return array
     */
    private function getForeignKeysDoc($docs)
    {

        $arrayForeignKeys = [];

        foreach ($this->dataBdAction["atributos"] as $key => $value) {

            $arrayDocs = DocsTools::docsToArray($docs[$key]);
            $table = DocsTools::getSimpleParameterDocs("foreign_key_table", $arrayDocs);
            $column = DocsTools::getSimpleParameterDocs("foreign_key_column", $arrayDocs);

            if ($table && $column) {
                $arrayForeignKeys[$key] = [
                    "table" => $table,
                    "column" => $column
                ];
            }
        }

        return $arrayForeignKeys;
    }

    private function getRequiredsDoc($docs)
    {

        $required = [];
        foreach ($this->dataBdAction["atributos"] as $key => $value) {

            //Tratar DOCS
            $arrayDocs = DocsTools::docsToArray($docs[$key]);
            if (DocsTools::isExistsParameter("required", $arrayDocs)
                && !DocsTools::isExistsParameter("auto_increment", $arrayDocs)
                && !DocsTools::isExistsParameter("default", $arrayDocs)) {
                $required[] = $key;
            }

        }

        return $required;
    }

    /**
     * Defini parâmetros contidos nos Docs da Classe
     * @param $classeName
     * @throws ReflectionException
     */
    private function getDocsClasse($classeName)
    {
        $reflector = new ReflectionClass($classeName);
        $docsClasse = $reflector->getDocComment();

        $arrayDocs = DocsTools::docsToArray($docsClasse);
        $this->dataBdAction["tabela"] = DocsTools::getSimpleParameterDocs("table", $arrayDocs);

    }

    /**
     * @param $bdAction PDOStatement
     * @return mixed
     */
    private function getResult($bdAction)
    {
        return $bdAction->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $bdAction PDOStatement
     * @return array
     */
    private function getOne($bdAction)
    {
        return $this->getResult($bdAction)[0];
    }

    /**
     * @return Model
     */
    private function getModel()
    {
        return $this->dataBdAction["model"];
    }

    /**
     * @return string
     */
    private function getTabela()
    {
        return $this->dataBdAction["tabela"];
    }

    /**
     * @param $sql
     * @param null $parameters
     * @return bool|PDOStatement
     * @throws Exception
     */
    private function execute($sql, $parameters = null)
    {
        try {

            $action = $this->getModel()->bd->prepare($sql);
            $action->execute($parameters);

            if ($action->errorInfo() && $action->errorInfo()[2]) {
                throw  new Exception($action->errorInfo()[2]);
            }

            return $action;

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

}
