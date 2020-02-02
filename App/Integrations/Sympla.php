<?php


namespace App\Integrations;

use Exception;

class Sympla
{

    const API_SYMPLA = "https://api.sympla.com.br/public/v3/events/";
    const ROUTE_PARTICIPANTS = "participants";

    /**
     * @param $id_evento
     * @param $st_chave
     * @param null $route
     * @return mixed
     * @throws Exception
     */
    public function eventsSympla($id_evento, $st_chave, $route = null)
    {
        $endpoint = self::API_SYMPLA . $id_evento . "/" . $route;
        $request_headers = $this->getHeader($st_chave);

        return $this->getArray($this->getResponse($endpoint, $request_headers));
    }

    /**
     * @param $st_chave
     * @return array
     */
    private function getHeader($st_chave)
    {
        return array(
            "s_token:" . $st_chave
        );
    }

    /**
     * @param $endpoint
     * @param $request_headers
     * @return bool|string
     */
    private function getResponse($endpoint, $request_headers)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $endpoint,
            CURLOPT_HTTPHEADER => $request_headers
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * @param $response
     * @return mixed
     * @throws Exception
     */
    private function getArray($response)
    {
        $array = json_decode($response, false);

        if (isset($array->error) && $array->error) {
            throw new Exception("Não foi possivel realizar a solicitação. $array->message");
        }

        return $array;
    }


}