<?php


namespace App\Model;


class Validate
{

    const DEFAULT_MESSAGE = "";

    const GLOBAL = [
//        "id_entidade" => "Identificador de entidade é obrigatório!"
    ];

    const JOGO = [
        "GLOBAL" => [
            "st_nome" => "O nome do jogo deve ser preenchido!",
            "st_descricao" => "A descrição do jogo eve ser preenchida!",
        ],
//        "CREATE" => [
//        ],
        "UPDATE" => [
            "id_jogo" => "O identificador do jogo deve ser enviado para realização da operação!"
        ]
    ];


}
