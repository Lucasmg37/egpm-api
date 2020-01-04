<?php


namespace App\Controller\Api;


use App\Model\Entity\Social;
use Exception;

class SocialController
{

    /**
     * @param $id_social
     * @return array|mixed
     * @throws Exception
     */
    public function getAction($id_social)
    {
        $social = new Social();

        if (!empty($id_social)) {
            return $social->findOne($id_social);
        }
        return $social->findAll();
    }

}