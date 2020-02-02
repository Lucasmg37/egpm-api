<?php


namespace App\Model;


class Validate
{

    const DEFAULT_MESSAGE = "";

    const GLOBAL = [];

    const JOGO = [
        "GLOBAL" => [
            "st_nome" => "O nome do jogo deve ser preenchido!",
            "st_descricao" => "A descrição do jogo deve ser preenchida!",
        ],
        "UPDATE" => [
            "id_jogo" => "O identificador do jogo deve ser enviado para realização da operação!"
        ]
    ];

    const AGENDA = [
        "GLOBAL" => [
            "st_nome" => "O assunto do agendamento deve ser preenchido.!",
            "st_descricao" => "A descrição do agendamento deve ser preenchida!",
            "nu_horario" => "O horário do agendamento deve ser preenchido!",
            "dt_data" => "A data do agendamento deve ser preenchida!",
        ],
        "UPDATE" => [
            "id_agenda" => "O identificador do agendamento deve ser enviado para realização da operação!"
        ]
    ];

    const USUARIO = [
        "GLOBAL" => [
            "st_nome" => "O nome do usuário deve ser informado.",
            "st_login" => "O login do usuário deve ser informado."
        ],
        "INSERT" => [
            "st_senha" => "A senha deve ser informada."
        ],
        "UPDATE" => [
            "IGNORE" => ["st_senha"],
            "id_usuario" => "O identificador do usuário deve ser enviado para realização da operação!"
        ]
    ];

    const DUVIDA = [
        "GLOBAL" => [
            "st_duvida" => "A dúvida deve ser informada!",
            "st_resposta" => "A resposta da dúvida deve ser informada!",
        ],
        "UPDATE" => [
            "id_duvida" => "O identificador da dúvida deve ser enviado para realizar a operação."
        ]
    ];

    const APOIO = [
        "GLOBAL" => [
            "st_email" => "E e-mail para contato deve ser informado.",
            "st_nome" => "O nome do responsável deve ser informado.",
            "st_empresa" => "A empresa interessada deve ser informada.",
            "st_telefone" => "O telefone para contato deve ser informado.",
        ]
    ];

    const PATROCINADOR = [
        "GLOBAL" => [
            "st_nome" => "O nome do patrocinador deve ser informado.",
            "id_tipo" => "O tipo do patrocinador deve ser informado.",
        ],
        "UPDATE" => [
            "id_patrocinador" => "O identificador do patrocinador deve ser enviado para realizar a operação."
        ]
    ];

    const COMENTARIO = [
        "GLOBAL" => [
            "st_autor" => "O nome do autor do comentário deve ser informado.",
            "st_comentario" => "O comentário deve ser informado.",
        ],
        "UPDATE" => [
            "id_comentario" => "O identificador do cometário deve ser enviado para realizar a operação."
        ]
    ];

    const SECAO = [
        "GLOBAL" => [
            "st_rota" => "A rota para realizar a requisicão deve ser informada.",
            "st_titulo" => "O título da seção deve ser informado.",
            "st_texto" => "O texto de descrição da seção deve ser informado.",
        ],
        "UPDATE" => [
            "IGNORE" => ["st_rota"],
            "id_secao" => "O identificador da seção deve ser enviado para realizar a operação."
        ]
    ];

    const ICONE = [
        "GLOBAL" => [
            "st_icone" => "O nome do ícone deve ser informado.",
            "st_valor" => "O valor do ícone deve ser informado.",
        ]
    ];

    const LOCALIZACAO = [
        "GLOBAL" => [
            "st_local" => "O local de realização deve ser informado.",
            "st_cep" => "O CEP do endereço deve ser informado.",
            "st_endereco" => "O endereço deve ser informado.",
        ],
        "UPDATE" => [
            "id_localizacao" => "O identificador da localização deve ser enviado para realizar a operação."
        ]
    ];

    const NOTIFICACAO = [
        "GLOBAL" => [
            "st_titulo" => "O asssunto da notificação  deve ser informado.",
            "st_descricao" => "O corpo da notificação deve ser informado.",
        ],
        "UPDATE" => [
            "id_notificao" => "O identificador da notificação deve ser enviado para realizar a operação."
        ]
    ];

    const INTEGRACAO = [
        "GLOBAL" => [
            "st_chave" => "A chave de acesso fornecida pelo Sympla deve ser informada.",
            "id_evento" => "O identificador do evento fornecido pelo Sympla deve ser informado.",
        ],
        "UPDATE" => [
            "id_integracaosympla" => "O identificador da integração deve ser enviado para realizar a operação."
        ]
    ];

    const UPLOAD_IMAGEM = [
        "GLOBAL" => [
            "st_nome" => "O nome da imagem deve ser informado.",
        ],
        "INSERT" => [
            "IGNORE" => ["id_imagem"]
        ],
        "UPDATE" => [
            "IGNORE" => ["id_imagem"],
            "id_uploadimagem" => "O identificador da imagem deve ser enviado para realizar a operação."
        ]
    ];
}
