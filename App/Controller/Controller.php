<?php

namespace App\Controller;

use App\Constants\System\BdAction;
use App\Model\File;
use App\Model\Model;
use App\Model\Render;
use App\Model\Request;
use App\Model\Response;

Class Controller
{
    /**
     * @var $request Request
     */
    public $request;
    public $model;
    public $response;
    public $render;
    public $file;

    public $BDA;

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getRender()
    {
        return $this->render;
    }

    /**
     * @param mixed $render
     */
    public function setRender($render)
    {
        $this->render = $render;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    public function __construct()
    {
        $this->setModel(new Model());
        $this->setRequest(new Request());
        $this->setResponse(new Response(null, null, null, null, null, null));
        $this->setRender(new Render());
        $this->BDA = new BdAction;
        $this->setFile(new File());
    }

    public function postAction()
    {
        Response::failResponse("Método não implementado.");
    }

    public function putAction()
    {
        Response::failResponse("Método não implementado.");
    }

    /**
     * @param $id
     */
    public function getAction($id)
    {
        Response::failResponse("Método não implementado.");
    }

    /**
     * @param $id
     */
    public function deleteAction($id)
    {
        Response::failResponse("Método não implementado.");
    }

}