<?php

namespace App\Controller\Api;

use App\Constants\System\App;
use App\Constants\TipoUsuario;
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

        //Dados do Usuário
        $st_email = $request->getParameter("st_email", true);
        $st_key = Helper::criptografaWithDate($st_email);
        $senha = Helper::criptografaWithKey($st_key, $request->getParameter("st_senhausuario", true));

        // Instanciando banco de dados e testando
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

        //Abrindo transaction
        $banco->getConexao()->beginTransaction();

        //Criando arquivo de configurações
        $texto[] = "[bd];";
        $texto[] = "st_name: PRIMARIO;";
        $texto[] = "st_user: " . $request->getParameter("st_nomebanco", true) . ";";
        $texto[] = "st_password: " . $request->getParameter("st_senhabanco", false) . ";";
        $texto[] = "st_dbname: " . $request->getParameter("st_banco", true) . ";";
        $texto[] = "st_host: " . $request->getParameter("st_servidor", true) . ";";

        $texto[] = "";
        $texto[] = "[email];";
        $texto[] = "host: " . $request->getParameter("st_servidoremail", true) . ";";
        $texto[] = "port: " . $request->getParameter("nu_porta", true) . ";";
        $texto[] = "username: " . $request->getParameter("st_usuarioemail", true) . ";";
        $texto[] = "password: " . $request->getParameter("st_senhaemail", true) . ";";
        $texto[] = "SMTPSecure: " . $request->getParameter("st_protocolo", true) . ";";
        $texto[] = "SMTPAuth: " . $request->getParameter("bl_smtpauth", true) . ";";
        $texto[] = "IsSMTP: " . $request->getParameter("bl_smtp", true) . ";";
        $texto[] = "from: " . $request->getParameter("st_emailfrom", true) . ";";
        $texto[] = "replyTo: " . $request->getParameter("st_replyemail", true) . ";";

        $texto[] = "";
        $texto[] = "[config];";
        $texto[] = "st_operacao: PRO;";
        $texto[] = "nu_minutossessao: " . $request->getParameter("nu_minutossessao", true) . ";";
        $texto[] = "st_senhacapcha: " . $request->getParameter("st_capcha", true) . ";";
        $texto[] = "st_key: " . $st_key . ";";

        $text = implode(App::BREAK_LINE, $texto);

        if (!is_dir("../config")) {
            mkdir("../config");
        }

        //Criando base de dados
        $sql_execute = file_get_contents("../config/DataBaseStructure.sql");
        $banco->getConexao()->exec($sql_execute);

        //Verifica se existem usuários na base
        $usuario = new Usuarios();
        $usuario->changeConnection($banco->getConexao());
        $usuarios = $usuario->findAll();

        if (sizeof($usuarios) > 0) {
            throw new Exception("Não foi possível salvar o usuário. Já existe um usuário cadastrado no banco!");
        }

        try {
            // Criando Tipos de Usuários
            $tipoUsuario = new \App\Model\Entity\Tipousuario();
            $tipoUsuario->changeConnection($banco->getConexao());
            $tipoUsuario->setIdTipousuario(1);
            $tipoUsuario->setStTipousuario("Administrador");
            $tipoUsuario->insert();

            $tipoUsuario->setIdTipousuario(2);
            $tipoUsuario->setStTipousuario("Padrão");
            $tipoUsuario->insert();

            $tipoUsuario->setIdTipousuario(3);
            $tipoUsuario->setStTipousuario("Participante");
            $tipoUsuario->insert();

            //Criando Usuário
            $usuario->clearObject();
            $usuario->setStNome("admin");
            $usuario->setStLogin("admin");
            $usuario->setStEmail($st_email);
            $usuario->setStSenha($senha);
            $usuario->setIdTipousuario(TipoUsuario::ADMINISTRADOR);
            $usuario->insert();

            if (!$usuario->getIdUsuario()) {
                throw new Exception("Ocorreu um erro ao criar o usuário.");
            }

            //Criando Seções base
            $secao = new \App\Model\Entity\Secao();
            $secao->changeConnection($banco->getConexao());
            $secao->setStTitulo("Titulo");
            $secao->setStTexto("Texto");
            $secao->setStRota("sobre-o-egpm");
            $secao->setBlHasicone(1);
            $secao->insert();

            $secao->setIdSecao(null);
            $secao->setStRota("campeonatos");
            $secao->setBlHasicone(0);
            $secao->setBlHasimagem(1);
            $secao->setBlHasvideo(0);
            $secao->insert();

            $secao->setIdSecao(null);
            $secao->setStRota("quizzes");
            $secao->setBlHasicone(0);
            $secao->setBlHasimagem(1);
            $secao->setBlHasvideo(0);
            $secao->insert();

            $secao->setIdSecao(null);
            $secao->setStRota("free-play");
            $secao->setBlHasicone(0);
            $secao->setBlHasimagem(1);
            $secao->setBlHasvideo(0);
            $secao->insert();

            $secao->setIdSecao(null);
            $secao->setStRota("na-midia");
            $secao->setBlHasicone(0);
            $secao->setBlHasimagem(0);
            $secao->setBlHasvideo(1);
            $secao->insert();

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