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
     * @param null $table
     * @return array|bool|void
     */
    public function getAction($table = null)
    {
        try {
            $entityg = new EntityGenerate();
            return $entityg->generateEntity($table);
        } catch (Exception $e) {
            Response::exceptionResponse($e);
            return true;
        }

    }

}