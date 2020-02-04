<?php

namespace App\Model;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{

    private $isSMTP = true;
    private $sMTPSecure = "ssl";
    private $charSet = "UTF-8";
    private $sMTPDebug = 0;
    private $host;
    private $sMTPAuth = true;
    private $port;
    private $username;
    private $password;

    private $setFrom;
    private $setFromAlias;
    private $addReplyTo;
    private $addReplyToAlias;
    private $subject;
    private $addAddress;
    private $msgHTML;

    private $altBody;
    private $priority = 1;
    private $encoding = "8bit";
    private $contentType = 'text/html; charset=utf-8\r\n';
    private $wordWrap = 900;
    private $isHTML = true;

    private $phpMailer;

    /**
     * SendMail constructor.
     */
    public function __construct()
    {
        $this->phpMailer = new PHPMailer();
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function mountPhpMailer()
    {
        if ($this->isSMTP) {
            $this->phpMailer->IsSMTP();
        }

        $this->phpMailer->Host = $this->getHost();
        $this->phpMailer->SMTPDebug = $this->getSMTPDebug();
        $this->phpMailer->SMTPAuth = $this->isSMTPAuth();
        $this->phpMailer->SMTPSecure = $this->getSMTPSecure();
        $this->phpMailer->Port = $this->getPort();
        $this->phpMailer->Username = $this->getUsername();
        $this->phpMailer->Password = $this->getPassword();
        $this->phpMailer->Priority = $this->getPriority();
        $this->phpMailer->CharSet = $this->getCharSet();
        $this->phpMailer->Encoding = $this->getEncoding();
        $this->phpMailer->Subject = $this->getSubject();
        $this->phpMailer->ContentType = $this->getContentType();
        $this->phpMailer->From = $this->getSetFrom();
        $this->phpMailer->FromName = $this->getSetFromAlias();
        $this->phpMailer->WordWrap = $this->getWordWrap();

        $this->phpMailer->AddAddress($this->getAddAddress());
        $this->phpMailer->isHTML($this->isHTML());
        $this->phpMailer->Body = $this->getMsgHTML();
        $this->phpMailer->AltBody = $this->getAltBody();
        $this->phpMailer->AddReplyTo($this->getAddReplyTo(), $this->getAddReplyToAlias());

        return $this;
    }

    /**
     * @param null $phpMailer
     * @return bool
     * @throws Exception
     */
    public function send($phpMailer = null)
    {
        if (!$phpMailer) {
            $phpMailer = $this->phpMailer;
        }

        $retorno = $phpMailer->Send();
        $phpMailer->SmtpClose();

        return $retorno;

    }

    /**
     * @param $file
     */
    public function setHtmlForFile($file)
    {
        $this->setMsgHTML(file_get_contents($file));
    }

    /**
     * @return bool
     */
    public function isSMTP()
    {
        return $this->isSMTP;
    }

    /**
     * @param bool $isSMTP
     */
    public function setIsSMTP($isSMTP)
    {
        $this->isSMTP = $isSMTP;
    }

    /**
     * @return string
     */
    public function getSMTPSecure()
    {
        return $this->sMTPSecure;
    }

    /**
     * @param string $sMTPSecure
     */
    public function setSMTPSecure($sMTPSecure)
    {
        $this->sMTPSecure = $sMTPSecure;
    }

    /**
     * @return string
     */
    public function getCharSet()
    {
        return $this->charSet;
    }

    /**
     * @param string $charSet
     */
    public function setCharSet($charSet)
    {
        $this->charSet = $charSet;
    }

    /**
     * @return int
     */
    public function getSMTPDebug()
    {
        return $this->sMTPDebug;
    }

    /**
     * @param int $sMTPDebug
     */
    public function setSMTPDebug($sMTPDebug)
    {
        $this->sMTPDebug = $sMTPDebug;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return bool
     */
    public function isSMTPAuth()
    {
        return $this->sMTPAuth;
    }

    /**
     * @param bool $sMTPAuth
     */
    public function setSMTPAuth($sMTPAuth)
    {
        $this->sMTPAuth = $sMTPAuth;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSetFrom()
    {
        return $this->setFrom;
    }

    /**
     * @param mixed $setFrom
     */
    public function setSetFrom($setFrom)
    {
        $this->setFrom = $setFrom;
    }

    /**
     * @return mixed
     */
    public function getSetFromAlias()
    {
        return $this->setFromAlias;
    }

    /**
     * @param mixed $setFromAlias
     */
    public function setSetFromAlias($setFromAlias)
    {
        $this->setFromAlias = $setFromAlias;
    }

    /**
     * @return mixed
     */
    public function getAddReplyTo()
    {
        return $this->addReplyTo;
    }

    /**
     * @param mixed $addReplyTo
     */
    public function setAddReplyTo($addReplyTo)
    {
        $this->addReplyTo = $addReplyTo;
    }

    /**
     * @return mixed
     */
    public function getAddReplyToAlias()
    {
        return $this->addReplyToAlias;
    }

    /**
     * @param mixed $addReplyToAlias
     */
    public function setAddReplyToAlias($addReplyToAlias)
    {
        $this->addReplyToAlias = $addReplyToAlias;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getAddAddress()
    {
        return $this->addAddress;
    }

    /**
     * @param mixed $addAddress
     */
    public function setAddAddress($addAddress)
    {
        $this->addAddress = $addAddress;
    }

    /**
     * @return mixed
     */
    public function getMsgHTML()
    {
        return $this->msgHTML;
    }

    /**
     * @param mixed $msgHTML
     */
    public function setMsgHTML($msgHTML)
    {
        $this->msgHTML = $msgHTML;
    }

    /**
     * @return mixed
     */
    public function getAltBody()
    {
        return $this->altBody;
    }

    /**
     * @param mixed $altBody
     */
    public function setAltBody($altBody)
    {
        $this->altBody = $altBody;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return int
     */
    public function getWordWrap()
    {
        return $this->wordWrap;
    }

    /**
     * @param int $wordWrap
     */
    public function setWordWrap($wordWrap)
    {
        $this->wordWrap = $wordWrap;
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

    /**
     * @return PHPMailer
     */
    public function getPhpMailer()
    {
        return $this->phpMailer;
    }

    /**
     * @param PHPMailer $phpMailer
     */
    public function setPhpMailer($phpMailer)
    {
        $this->phpMailer = $phpMailer;
    }




}