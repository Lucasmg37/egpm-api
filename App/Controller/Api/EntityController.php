<?php


namespace App\Controller\Api;

use App\Controller\Controller;
use App\Model\Entity\EntityGenerate;
use App\Model\Response;
use Exception;


class EntityController extends Controller
{
    /**
     * EntityController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|bool
     */
    public function getAction()
    {
        try {
            $entityg = new EntityGenerate();
            return $entityg->generateEntity();
        } catch (Exception $e) {
            Response::exceptionResponse($e);
            return true;
        }

    }

}