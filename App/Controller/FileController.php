<?php

namespace App\Controller;

use App\Model\Model;

Class FileController
{
    public static function show($st_imagem)
    {

        if (empty($st_imagem)) {
            Model::failJson("Nome da imagem não enviado!");
        }


        $caminho_imagem = "../files/" . $st_imagem;

        $mime = mime_content_type( $caminho_imagem);
        $tamanho = filesize($caminho_imagem);

        if (!$mime) {
            Model::failJson("Arquivo não encontrado!");
        }

        header("Content-Type: " . $mime);
        header("Content-Length: " . $tamanho);

        echo file_get_contents($caminho_imagem);
        exit;

    }

}