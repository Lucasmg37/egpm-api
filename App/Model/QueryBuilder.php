<?php

namespace App\Model;


class QueryBuilder extends Model
{

    private $sql;
    public $select;
    public $parametros = [];
    public $where = [];
    public $table;
    public $join = [];
    public $order;
    public $update = [];


    public function prepare()
    {
        try {

            if (empty($this->select) || empty($this->table)) {
                throw new \Exception("Dados em falta para realizar a operação!");
            }

            $this->setSql($this->select);
            $this->setSql($this->table);

            if (!empty($this->update[0])) {
                foreach ($this->update as $update){
                    $this->setSql($update);
                }
            }

            if (!empty($this->join[0])) {
                foreach ($this->join as $join){
                    $this->setSql($join);
                }
            }

            if (!empty($this->where[0])) {
                foreach ($this->where as $where){
                    $this->setSql($where);
                }
            }

            $this->setSql($this->order);

        } catch (\Exception $e) {
            $this->lancaErro($e);
        }
    }

    public function execute(){
        try {

            if (empty($this->sql)) {
                throw new \Exception("Sql não disponível! Utilize o prepare().");
            }

            $execute = $this->bd->prepare($this->getSql());
            $ok = $execute->execute($this->parametros);

            if (!$ok) {
                throw new \Exception($execute->errorInfo()[2], 400);
            }
            return $this->trataRetornoAllArray($execute);

        } catch (\Exception $e) {
            $this->lancaErro($e);
        }
    }

    /**
     * @return mixed
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @param mixed $sql
     */
    public function setSql($sql)
    {
        $this->sql .= " " . $sql . " ";
    }

    /**
     * @return mixed
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * @param mixed $select
     */
    public function setSelect($select)
    {
        $this->select = $select;
    }

    /**
     * @return array
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * @param array $parametros
     */
    public function setParametros($parametros)
    {
        $this->parametros = $parametros;
    }

    /**
     * @return array
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param string $where
     */
    public function setWhere($where)
    {
        $this->where[] = $where;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return array
     */
    public function getJoin()
    {
        return $this->join;
    }

    /**
     * @param string $join
     */
    public function setJoin($join)
    {
        $this->join[] = $join;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param string $update
     */
    public function setUpdate($update)
    {
        $this->update[] = $update;
    }



}