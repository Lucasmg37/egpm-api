<?php


namespace App\Model;


class Response
{

    const TYPE_REQUEST_ERROR = 'error';
    const TYPE_REQUEST_SUCCESS = 'success';

    const CODE_400_BAD_REQUEST = 'HTTP/1.1 400 Bad Request';
    const CODE_200_OK = 'HTTP/1.1 200 OK';

    private $httpCode = self::CODE_200_OK;
    private $type;
    private $status;
    private $message;
    private $data;
    private $errorCode;

    /**
     * Response constructor.
     * @param $httpCode
     * @param $type
     * @param $status
     * @param $message
     * @param $data
     * @param $errorCode
     */
    public function __construct($httpCode, $type, $status, $message, $data, $errorCode)
    {
        $this->httpCode = $httpCode;
        $this->type = $type;
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->errorCode = $errorCode;
    }


    public static function setCodeHeaderResponse($st_code)
    {
        header($st_code);
    }

    /**
     * @param $message
     * @param int $codeHttp
     * @param null $data
     * @param null $errorCode
     */
    public static function failResponse($message, $data = null, $errorCode = null)
    {
        $response = new Response(self::CODE_400_BAD_REQUEST, self::TYPE_REQUEST_ERROR, false, $message, $data, $errorCode);
        $response->responseReturn();

    }


    /**
     * @param null $message
     * @param int $codeHttp
     * @param array $data
     */
    public static function succesResponse($message = null, $data = [])
    {
        $response = new Response(self::CODE_200_OK, self::TYPE_REQUEST_SUCCESS, true, $message, $data, null);
        $response->responseReturn();
    }

    /**
     * @param $e \Exception
     */
    public static function exceptionResponse($e)
    {
        $response = new Response(self::CODE_400_BAD_REQUEST, self::TYPE_REQUEST_ERROR, false, $e->getMessage(), null, $e->getCode());
        $response->responseReturn();
    }

    public function responseReturn()
    {
        self::setCodeHeaderResponse($this->getHttpCode());

        $retorno["status"] = $this->getStatus();
        $retorno["type"] = $this->getType();

        if ($this->getMessage()) {
            $retorno["message"] = $this->getMessage();
        }

        $retorno["data"] = $this->getData();

        if ($this->getErrorCode()) {
            $retorno["code"] = $this->getErrorCode();
        }

        echo json_encode($retorno, JSON_NUMERIC_CHECK);
        exit;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }


}
