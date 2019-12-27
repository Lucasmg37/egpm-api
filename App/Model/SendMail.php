<?php

namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class SendMail extends Model
{

    private $IsSMTP = true;
    private $SMTPSecure = "ssl";
    private $charSet = "UTF-8";
    private $SMTPDebug = 0;
    private $Host;
    private $SMTPAuth = true;
    private $Port;
    private $Username;
    private $Password;

    private $SetFrom;
    private $SetFromAlias;
    private $AddReplyTo;
    private $AddReplyToAlias;
    private $Subject;
    private $AddAddress;
    private $MsgHTML;

    private $AltBody;
    private $Priority = 1;
    private $Encoding = "8bit";
    private $ContentType = 'text/html; charset=utf-8\r\n';
    private $WordWrap = 900;
    private $isHTML = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function sendEmail()
    {
        try {

//            var_dump("dfvsdv");
//            exit;

            $Mail = new PHPMailer(true);

            if ($this->IsSMTP) {
                $Mail->IsSMTP();
            }

            $Mail->Host        = $this->getHost();
            $Mail->SMTPDebug   = $this->getSMTPDebug();
            $Mail->SMTPAuth    = $this->getSMTPAuth();
            $Mail->SMTPSecure  = $this->getSMTPSecure();
            $Mail->Port        = $this->getPort();
            $Mail->Username    = $this->getUsername();
            $Mail->Password    = $this->getPassword();
            $Mail->Priority    = $this->getPriority();
            $Mail->CharSet     = $this->getCharSet();
            $Mail->Encoding    = $this->getEncoding();
            $Mail->Subject     = $this->getSubject();
            $Mail->ContentType = $this->getContentType();
            $Mail->From        = $this->getSetFrom();
            $Mail->FromName    = $this->getSetFromAlias();
            $Mail->WordWrap    = $this->getWordWrap();

            $Mail->AddAddress( $this->getAddAddress());
            $Mail->isHTML($this->isHTML());
            $Mail->Body    = $this->getMsgHTML();
            $Mail->AltBody = $this->getAltBody();
            $Mail->AddReplyTo($this->AddReplyTo, $this->AddReplyToAlias);

//            var_dump($Mail);
//            exit;

            $retorno = $Mail->Send();

            $Mail->SmtpClose();

//            var_dump($Mail);
//            exit;

            return $retorno;

        } catch ( \phpmailerException $e) {

            return $this->fail($e->getMessage());

        }catch (\Exception $e){
            Response::failResponse($e->getMessage(), $e);
        }
    }



    /**
     * @return mixed
     */
    public function getIsSMTP()
    {
        return $this->IsSMTP;
    }

    /**
     * @param mixed $IsSMTP
     * @return $this
     */
    public function setIsSMTP($IsSMTP)
    {
        $this->IsSMTP = $IsSMTP;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSMTPSecure()
    {
        return $this->SMTPSecure;
    }

    /**
     * @param mixed $SMTPSecure
     * @return $this
     */
    public function setSMTPSecure($SMTPSecure)
    {
        $this->SMTPSecure = $SMTPSecure;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharSet()
    {
        return $this->charSet;
    }

    /**
     * @param mixed $charSet
     * @return $this
     */
    public function setCharSet($charSet)
    {
        $this->charSet = $charSet;
        return $this;
    }

    /**
     * @return int
     */
    public function getSMTPDebug()
    {
        return $this->SMTPDebug;
    }

    /**
     * @param int $SMTPDebug
     * @return $this
     */
    public function setSMTPDebug($SMTPDebug)
    {
        $this->SMTPDebug = $SMTPDebug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->Host;
    }

    /**
     * @param mixed $Host
     * @return $this
     */
    public function setHost($Host)
    {
        $this->Host = $Host;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSMTPAuth()
    {
        return $this->SMTPAuth;
    }

    /**
     * @param mixed $SMTPAuth
     * @return $this
     */
    public function setSMTPAuth($SMTPAuth)
    {
        $this->SMTPAuth = $SMTPAuth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->Port;
    }

    /**
     * @param mixed $Port
     * @return $this
     */
    public function setPort($Port)
    {
        $this->Port = $Port;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @param mixed $Username
     * @return $this
     */
    public function setUsername($Username)
    {
        $this->Username = $Username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     * @return $this
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSetFrom()
    {
        return $this->SetFrom;
    }

    /**
     * @param mixed $SetFrom
     * @return $this
     */
    public function setSetFrom($SetFrom)
    {
        $this->SetFrom = $SetFrom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddReplyTo()
    {
        return $this->AddReplyTo;
    }

    /**
     * @param mixed $AddReplyTo
     * @return $this
     */
    public function setAddReplyTo($AddReplyTo)
    {
        $this->AddReplyTo = $AddReplyTo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param mixed $Subject
     * @return $this
     */
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddAddress()
    {
        return $this->AddAddress;
    }

    /**
     * @param mixed $AddAddress
     * @return $this
     */
    public function setAddAddress($AddAddress)
    {
        $this->AddAddress = $AddAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMsgHTML()
    {
        return $this->MsgHTML;
    }

    /**
     * @param mixed $MsgHTML
     * @return $this
     */
    public function setMsgHTML($MsgHTML)
    {
        $this->MsgHTML = $MsgHTML;
        return $this;
    }

    public function setHtmlForFile($file)
    {
        $this->setMsgHTML(file_get_contents($file));
    }

    /**
     * @return mixed
     */
    public function getSetFromAlias()
    {
        return $this->SetFromAlias;
    }

    /**
     * @param mixed $SetFromAlias
     */
    public function setSetFromAlias($SetFromAlias)
    {
        $this->SetFromAlias = $SetFromAlias;
    }

    /**
     * @return mixed
     */
    public function getAddReplyToAlias()
    {
        return $this->AddReplyToAlias;
    }

    /**
     * @param mixed $AddReplyToAlias
     */
    public function setAddReplyToAlias($AddReplyToAlias)
    {
        $this->AddReplyToAlias = $AddReplyToAlias;
    }

    /**
     * @return mixed
     */
    public function getAltBody()
    {
        return $this->AltBody;
    }

    /**
     * @param mixed $AltBody
     */
    public function setAltBody($AltBody)
    {
        $this->AltBody = $AltBody;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->Priority;
    }

    /**
     * @param int $Priority
     */
    public function setPriority($Priority)
    {
        $this->Priority = $Priority;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->Encoding;
    }

    /**
     * @param string $Encoding
     */
    public function setEncoding($Encoding)
    {
        $this->Encoding = $Encoding;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->ContentType;
    }

    /**
     * @param string $ContentType
     */
    public function setContentType($ContentType)
    {
        $this->ContentType = $ContentType;
    }

    /**
     * @return int
     */
    public function getWordWrap()
    {
        return $this->WordWrap;
    }

    /**
     * @param int $WordWrap
     */
    public function setWordWrap($WordWrap)
    {
        $this->WordWrap = $WordWrap;
    }

    /**
     * @return bool
     */
    public function isHTML()
    {
        return $this->isHTML;
    }

    /**
     * @param bool $isHTML
     */
    public function setIsHTML($isHTML)
    {
        $this->isHTML = $isHTML;
    }




}