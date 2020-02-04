<?php

namespace App\Model;

use Exception;

class Request
{

    public $request;

    public $post;
    public $get;
    public $put;
    public $all;
    public $file;

    public $superPost;
    public $superGet;

    /**
     * @return mixed
     */
    public function getAllSuperPost()
    {
        return $this->superPost;
    }

    /**
     * @param $campo
     * @param bool $campovazio
     * @return mixed
     */
    public function getSuperPost($campo, $campovazio = false)
    {
        try {
            if (isset($this->superPost[$campo])) {
                return $this->superPost[$campo];
            } else {
                if ($campovazio) {
                    throw new Exception("Campo -> $campo não disponível no request");
                } else {
                    return null;
                }
            }
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return null;
    }

    /**
     * @param mixed $all
     */
    public function setAll($all)
    {
        $this->all = $all;
    }

    /**
     * @param mixed $superPost
     */
    public function setSuperPost($superPost)
    {
        $this->superPost = $superPost;
    }

    public function __construct()
    {
        $this->request = $_SERVER["REQUEST_METHOD"];

        $this->setAll(json_decode(file_get_contents('php://input'), true));
        $this->superPost = $_POST;
        $this->superGet = $_GET;

        if ($this->request === "PUT") {
            $this->setPut(json_decode(file_get_contents('php://input'), true));
        }

        if ($this->request === "POST") {
            $this->setPost(json_decode(file_get_contents('php://input'), true));;
        }

        if ($this->request === "GET") {
            $this->setGet($_GET);
        }

        if (isset($_FILES)) {
            $this->setFile($_FILES);
        }

    }

    /**
     * @return mixed
     */
    public function getAllPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     * @return $this
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllGet()
    {
        return $this->get;
    }

    /**
     * @param mixed $get
     * @return $this
     */
    public function setGet($get)
    {
        $this->get = $get;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllPut()
    {
        return $this->put;
    }

    /**
     * @param mixed $put
     * @return $this
     */
    public function setPut($put)
    {
        $this->put = $put;
        return $this;
    }


    /**
     * @param $campo
     * @param bool $lancaerro
     * @return mixed
     */
    public function getPost($campo, $lancaerro = false)
    {
        try {
            if (isset($this->post[$campo])) {
                return $this->post[$campo];
            } else {
                if ($lancaerro) {
                    throw new Exception("Campo -> $campo não disponível em POST");
                } else {
                    return null;
                }
            }
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return null;
    }

    /**
     * @param $campo
     * @param bool $lancaerro
     * @return mixed
     */
    public function getSuperGet($campo, $lancaerro = false)
    {
        try {
            if (isset($this->superGet[$campo])) {
                return $this->superGet[$campo];
            } else {
                if ($lancaerro) {
                    throw new Exception("Campo -> $campo não disponível em GET");
                } else {
                    return "";
                }
            }
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return null;
    }


    /**
     * @param $campo
     * @return mixed
     */
    public function getGet($campo)
    {
        try {
            if (isset($this->get[$campo])) {
                return $this->get[$campo];
            } else {
                throw new Exception("Campo -> $campo não disponível em GET");
            }
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return null;
    }

    /**
     * @param $campo
     * @return mixed
     */
    public function getPut($campo)
    {
        try {
            if (isset($this->put[$campo])) {
                return $this->put[$campo];
            } else {
                throw new Exception("Campo -> $campo não disponível em PUT");
            }
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return null;
    }

    /**
     * @param $campo
     * @param bool $lancaErro
     * @return mixed
     */
    public function getFile($campo, $lancaErro = true)
    {

        try {
            if (isset($this->file[$campo])) {
                return $this->file[$campo];
            } else {
                if ($lancaErro) {
                    throw new Exception("Arquivo obrigatório não foi encontrado!");
                }
                return null;
            }
        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }
        return null;
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
    public function getAllFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getAllParameters()
    {

        try {

            if ($this->all) {
                return $this->all;
            }

            if ($this->get) {
                return $this->get;
            }

            if ($this->post) {
                return $this->post;
            }

            if ($this->put) {
                return $this->put;
            }
            if ($this->superGet) {
                return $this->superGet;
            }

            if ($this->superPost) {
                return $this->superPost;
            }

            throw new Exception("Request sem parâmetros!");

        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return null;
    }

    /**
     * @param $campo
     * @param bool $campovazio
     * @return string|array
     */
    public function getParameter($campo, $campovazio = false, $messageError = null)
    {

        try {

            if ($this->all[$campo]) {
                return $this->all[$campo];
            }

            if (isset($this->get[$campo]) && $this->get[$campo]) {
                return $this->get[$campo];
            }

            if (isset($this->post[$campo]) && $this->post[$campo]) {
                return $this->post[$campo];
            }

            if (isset($this->put[$campo]) && $this->put[$campo]) {
                return $this->put[$campo];
            }
            if (isset($this->superGet[$campo]) && $this->superGet[$campo]) {
                return $this->superGet[$campo];
            }

            if (isset($this->superPost[$campo]) && $this->superPost[$campo]) {
                return $this->superPost[$campo];
            }

            if ($campovazio) {
                if ($messageError) {
                    throw new Exception($messageError);
                }
                throw new Exception("O $campo deve ser enviado.");
            }

        } catch (Exception $e) {
            Response::exceptionResponse($e);
        }

        return "";
    }


}
