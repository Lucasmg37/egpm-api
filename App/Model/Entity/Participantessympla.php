<?php

namespace App\Model\Entity;

use App\Model\BdAction;
use Exception;

/**
 * Class Participantessympla
 * @package App\Model\Entity
 * @table tb_participantessympla
 */
class Participantessympla extends BdAction
{

    /**
     * Participantessympla constructor.
     * @param null $parameters
     * @throws Exception
     */
    public function __construct($parameters = null)
    {
        parent::__construct($this, $parameters);
    }

    /**
     * @var $id
     * @primary_key
     * @required
     */
    public $id;


    /**
     * @var $order_id
     * @required
     */
    public $order_id;


    /**
     * @var $ticket_number
     * @required
     */
    public $ticket_number;


    /**
     * @var $first_name
     * @required
     */
    public $first_name;


    /**
     * @var $last_name
     * @required
     */
    public $last_name;


    /**
     * @var $email
     * @required
     */
    public $email;


    /**
     * @var $check_in
     * @required
     */
    public $check_in;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
    }


    /**
     * @return string
     */
    public function getTicketNumber()
    {
        return $this->ticket_number;
    }


    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }


    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @return boolean
     */
    public function getCheckIn()
    {
        return $this->check_in;
    }



    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $ticket_number
     */
    public function setTicketNumber($ticket_number)
    {
        $this->ticket_number = $ticket_number;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        $this->atualizaAtributos($this);
    }


    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        $this->atualizaAtributos($this);
    }


    /**
     * @param boolean $check_in
     */
    public function setCheckIn($check_in)
    {
        $this->check_in = $check_in;
        $this->atualizaAtributos($this);
    }



}