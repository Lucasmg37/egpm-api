<?php

namespace App\Controller\Api;

use App\Controller\Controller;
use App\Model\Banco;
use App\Model\Entity\Usuarios;
use App\Model\Request;
use App\Model\Response;
use App\Util\Helper;
use Exception;

Class IndexController extends Controller
{

    /**
     * Default Action
     */
    public function executeAction()
    {
        Response::succesResponse("Tudo certo por aqui!");
    }

    /**
     * @return bool
     */
    public function getStatusConfiguracaoAction()
    {
        if (file_exists("../config/config")) {
            return true;
        }
        Response::failResponse("O arquivo de configuração não existe.");
        return false;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function salvarConfiguracaoAction()
    {
        $request = new Request();

        if (file_exists("../config/config")) {
            throw new Exception("O arquivo de configuração já existe, ele deve ser removido para realizar esta operação.");
        }

        $banco = new Banco();
        $banco->setPassword($request->getParameter("st_senhabanco", false));
        $banco->setHost($request->getParameter("st_servidor", true));
        $banco->setUser($request->getParameter("st_nomebanco", true));
        $banco->setBd($request->getParameter("st_banco", true));

        try {
            $banco->conexaoMySql();
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro ao realizar a conexão com o banco de dados! " . $e->getMessage());
        }

        $texto[] = "[bd];";
        $texto[] = "st_name: PRIMARIO;";
        $texto[] = "st_user: " . $request->getParameter("st_nomebanco", true) . ";";
        $texto[] = "st_password: " . $request->getParameter("st_senhabanco", false) . ";";
        $texto[] = "st_dbname: " . $request->getParameter("st_banco", true) . ";";
        $texto[] = "st_host: " . $request->getParameter("st_servidor", true) . ";";

        $texto[] = "";
        $texto[] = "[config];";
        $texto[] = "st_operacao: PRO;";
        $texto[] = "nu_minutossessao: " . $request->getParameter("nu_minutossessao", true) . ";";
        $texto[] = "st_senhacapcha: " . $request->getParameter("st_capcha", true) . ";";

        $st_key = Helper::criptografaWithDate($request->getParameter("st_email", true));
        $texto[] = "st_key: " . $st_key . ";";

        $text = implode("\r\n", $texto);

        if (!is_dir("../config")) {
            mkdir("../config");
        }

        $sql_execute = file_get_contents("../config/DataBaseStructure.sql");
        $banco->getConexao()->exec($sql_execute);

        $usuario = new Usuarios();
        $usuario->changeConnection($banco->getConexao());
        $usuarios = $usuario->findAll();

        if (sizeof($usuarios) > 0) {
            throw new Exception("Não foi possível salvar o usuário. Já existe um usuário cadastrado no banco!");
        }

        try {
            $banco->getConexao()->beginTransaction();
            $insertTipoUsuario = "INSERT INTO tb_tipousuario (id_tipousuario, st_tipousuario) VALUES (1, 'Administrador'), (2, 'Padrão'), (3, 'Participante');";
            $banco->getConexao()->exec($insertTipoUsuario);

            $senha = Helper::criptografaWithKey($st_key, $request->getParameter("st_senhausuario", true));
            $insertUsuario = "INSERT INTO tb_usuarios (st_nome, st_login, st_senha, id_tipousuario) VALUES ('admin', 'admin', '" . $senha . "', 1 );";
            $banco->getConexao()->exec($insertUsuario);

            $banco->getConexao()->commit();

        } catch (Exception $e) {
            $banco->getConexao()->rollBack();
            throw  $e;
        }

        $fileEdit = fopen("../config/config", 'w');
        fwrite($fileEdit, $text);
        fclose($fileEdit);

        return true;
    }
}