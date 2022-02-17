<?php


namespace App\Integrations;

use Exception;

class Imgur
{
    public function uploadImage($file_path)
    {
        $curl = curl_init();

        $imagedata = file_get_contents($file_path);
        $base64 = base64_encode($imagedata);


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.imgur.com/3/image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('image' => $base64, 'type' => 'base64'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Client-ID 9057637602d7d6e'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, false);

        if (!$response->data->link) {
            throw new Exception("Não foi possível realizar o upload da imagem");
        }

        return $response->data->link;
    }
}
