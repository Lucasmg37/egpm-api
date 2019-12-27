<?php

namespace Bootstrap;

use App\Model\Autentication;
use App\Model\Response;
use App\Routes\Route;
use Exception;

Class Router
{


    /**
     * Verbo HTTP
     * @var mixed
     */
    public $request;

    //Atributos utilizados para o roteamento
    /**
     * Nome da controller a ser chamada
     * @var $controller
     */
    public $controller = null;

    /**
     * Parâmetros acessíveis no método chamado
     * @var $parameters
     */
    public $parameters = null;

    /**
     * Método da controller a ser chamado
     * @var $action
     */
    public $action = null;

    /**
     * Autenticação de Rota
     * @var $autenticated
     */
    public $autenticated = true;

    /**
     * Parâmetro unico passado para o método
     * @var $unique
     */
    public $unique = null;

    //Amientes que operação pode ser executada - Padrão PRODUÇÃO e DESENVOLVIMENTO
    public $operation = ["PRO", "DEV"];

    // Rotas personalizadas liberadas
    private $assignatureRoutes = [];

    public $isApi = false;

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getAutenticated()
    {
        return $this->autenticated;
    }

    /**
     * @param mixed $autenticated
     */
    public function setAutenticated($autenticated)
    {
        $this->autenticated = $autenticated;
    }

    /**
     * @return mixed
     */
    public function getUnique()
    {
        return $this->unique;
    }

    /**
     * @param mixed $unique
     */
    public function setUnique($unique)
    {
        $this->unique = $unique;
    }

    /**
     * @return array
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param array $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return bool
     */
    public function isApi()
    {
        return $this->isApi;
    }

    /**
     * @param bool $isApi
     */
    public function setIsApi($isApi)
    {
        $this->isApi = $isApi;
    }

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->request = $_SERVER["REQUEST_METHOD"];

        //Rotas do default
        self::setNewRoute("GET", "*", "get");
        self::setNewRoute("DELETE", "*", "delete");
        self::setNewRoute("PUT", "*", "put");
        self::setNewRoute("POST", "*", "post");

    }

    /**
     * Retorna método padrão da requisição informada
     * @param null $verb
     * @return bool|string
     */
    public function returnActionByVerb($verb = null)
    {
        if (empty($verb)) {
            $verb = $this->request;
        }

        switch ($verb) {
            case "GET" :
                return "get";
            case "POST" :
                return "post";
            case "PUT" :
                return "put";
            case "DELETE" :
                return "delete";
        }

        return false;
    }

    /**
     * Início de roteamento
     * Parametros tratados são alocados de acordo com a regra de negócio, na clase Router
     * @param $parametrosURI
     * @return Router
     * @throws Exception
     */
    public static function begin($parametrosURI)
    {
        $router = new Router();
        $controller = ucfirst($parametrosURI["controller"]);
        $action = $parametrosURI["action"];
        $autenticado = null;
        $unique = null;
        $data = null;

        if (empty($controller)) {
            $controller = "Index";
            $action = "render";

            if ($parametrosURI["isApi"]) {
                $action = "execute";
            }
        }

        /**
         * Se a ação da rota está vazia ou é inválida, pegamos a padrão
         */
        if (empty($action)) {
            $action = $router->returnActionByVerb();
        }

        // Verificar se a ação é válida
        /**
         * @var $routeObject Route
         */
        $routeObject = self::returnClassRouter($controller);

        $router = $routeObject->getRouter();
        $rotaValida = $router->validateRouter($controller, $action);

        if (is_array($rotaValida) && sizeof($rotaValida) > 1) {
            Response::failResponse("Existem rotas conflitantes.", $rotaValida);
        }

        if (is_array($rotaValida)) {
            $rotaValida = $rotaValida[0];
        }

        /**
         * Se a ação existe e é inválida, a ação é um parâmetro
         */
        if (!empty($action) && !$rotaValida) {
            $unique = $action;
            $action = $router->returnActionByVerb();
        } elseif ($rotaValida) {
            $unique = $parametrosURI["parametrosMontados"][$action];
        }

        /**
         * Se a rota é vallida, usarei o seu retorno para definição das regras de roteamento
         */
        $action = !empty($rotaValida["actionCall"]) ? $rotaValida["actionCall"] : $action;
        $controller = !empty($rotaValida["controllerCall"]) ? $rotaValida["controllerCall"] : $controller;
        $autenticado = $rotaValida["autenticado"] === null ? null : $rotaValida["autenticado"];

        /**
         * Salva a data (parâmetros) quando existirem
         */
        if (sizeof($parametrosURI["parametrosMontados"]) > 0) {
            $data = $parametrosURI["parametrosMontados"];
        }

        //Se o método estiver definido na Classe, irei chama-lo
        $actionCall = $action . "Route";

        $rota = true;
        if (method_exists($routeObject, $actionCall)) {
            $rota = $routeObject->$actionCall($parametrosURI, $parametrosURI["parametrosMontados"]);
        }

        /**
         * @var $rota Router
         */
        if (is_a($rota, "Router")) {
            $controller = $rota->controller ? $rota->controller : $controller;
            $action = $rota->action ? $rota->action : $action;
            $unique = $rota->unique ? $rota->unique : $unique;
            $data = $rota->parameters ? $rota->parameters : $data;
            $autenticado = $rota->autenticated ? $rota->autenticated : $autenticado;
        }

        if (!$rota) {
            throw new Exception("Não foi possível realizar requisição!");
        }

        $router->setIsApi($parametrosURI["isApi"]);
        $router->setController($controller);
        $router->setAction($action);
        $router->setUnique($unique);
        $router->setParameters($data);
        $router->setAutenticated($autenticado !== null ? $autenticado : $router->autenticated);

        return $router;
    }

    /**
     * Verifica se a rota está criada
     * @param $controller
     * @param $action
     * @return bool|mixed
     */
    public function validateRouter($controller, $action)
    {
        $request = $this->request;
        $validas = [];
        $rota = false;

        foreach ($this->assignatureRoutes as $route) {
            if ($route["verbohttp"] === $request) {
                $validas[] = $route;
            }
        }

        foreach ($validas as $valida) {
            if ($valida["action"] !== $action) {
                continue;
            }

            if ($valida["controller"] === $controller || $valida["controller"] === "*") {
                //Se for uma rota todas as conntrollers, retorno com a rota pesquisada
                if ($valida["controller"] === "*") {
                    $valida["controller"] = $controller;
                    $valida["controllerCall"] = $controller;
                }
                $rota[] = $valida;
            }
        }

        return $rota;
    }

    /**
     * Retorna objeto Route de acordo com a Controller
     * @param $controller
     * @return Route
     */
    public static function returnClassRouter($controller)
    {

        $classeRota = "App\Routes\\" . ucfirst($controller);

        if (!file_exists("../App/Routes/" . ucfirst($controller) . ".php")) {
            $classeRota = "App\Routes\Route";
        }

        return new $classeRota();
    }

    /**
     * Chama a Controller e aplica regras do roteamento
     * @param $router Router
     * @return bool
     * @throws Exception
     */
    public static function execute($router)
    {
        //Verificar o ambiente
        $config = new Config();
        $ambiente = $config->getConfig("st_operacao");

        $isAmbienteValido = false;

        foreach ($router->getOperation() as $operation) {
            if ($operation === $ambiente) {
                $isAmbienteValido = true;
                break;
            }
        }

        if (!$isAmbienteValido) {
            throw new Exception("Operação não permitida neste modo de operação. [$ambiente]");
        }

        //Validar autenticação
        if ($router->getAutenticated()) {
            $classAutentication = new Autentication();
            if ($classAutentication->validateController($router)) {
                $isAutenticado = $classAutentication->getAutenticado();
            } else {
                $isAutenticado = false;
            }
        } else {
            $isAutenticado = true;
        }

        if (!$isAutenticado) {
            throw new Exception("Ocorreu um erro ao realizar a autenticação do usuário!");
        }

        //Validar o controller e o  método
        //Se for API devo buscar a controller na pasta Api
        $pathController = "../App/Controller/" . $router->getController() . "Controller.php";
        $namespaceController = "\App\Controller\\" . $router->getController() . "Controller";

        if ($router->isApi()) {
            $pathController = "../App/Controller/Api/" . $router->getController() . "Controller.php";
            $namespaceController = "\App\Controller\Api\\" . $router->getController() . "Controller";
        }

        if (!file_exists($pathController)) {
            Response::failResponse("Controller não encontrada.", $pathController);
        }

        //Adicionando 'Action' na ação enviada
        $action = $router->getAction() . "Action";

        $classeController = new $namespaceController();
        if (!method_exists($classeController, $action)) {
            throw new Exception("$action, não foi encontrado na Controller $namespaceController");
        }

        //Chamar a Controller
        //Verificar se existe Unique e Parameter
        if (!$router->getUnique() && !sizeof($router->getParameters()) > 0) {
            Response::succesResponse("Operação realizada com sucesso!", $classeController->$action());
            return true;
        }

        Response::succesResponse("Operação realizada com sucesso!",
            $classeController->$action($router->getUnique(), $router->getParameters()));
        return true;

    }

    /**
     * Adiciona rota personalizada
     * @param $verboHttp
     * @param $controller
     * @param $action
     * @param null $autenticated
     * @return array
     */
    public function setNewRoute($verboHttp, $controller, $action, $autenticated = null)
    {
        $newRoute = [
            "action" => $action,
            "actionCall" => $action,
            "verbohttp" => $verboHttp,
            "autenticado" => $autenticated,
            "controller" => $controller,
            "controllerCall" => $controller
        ];

        $this->assignatureRoutes[] = $newRoute;

        return $newRoute;
    }

    /**
     * Altera rota personalizada criada
     * @param $controller
     * @param $action
     * @param null $newController
     * @param null $newAction
     * @param null $autenticated
     * @throws Exception
     */
    public function changeRoute($controller, $action, $newController = null, $newAction = null, $autenticated = null)
    {

        if (!$controller) {
            throw new Exception("Controller não informada!");
        }

        if (!$action) {
            throw new Exception("Ação não informada!");
        }

        foreach ($this->assignatureRoutes as &$route) {
            if ($route["action"] === $action
                && ($route["controller"] === $controller || $route["controller"] === "*")) {

                if ($newController) {
                    $route["controllerCall"] = $newController;
                }

                if ($newAction) {
                    $route["actionCall"] = $newAction;
                }

                if ($autenticated !== null) {
                    $route["autenticado"] = $autenticated;
                }

            }
        }

    }


}
