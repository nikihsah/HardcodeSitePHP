<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Проверка URL  адрессов
     *
     * @return string|null
     */
    private function getURI(): ?string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return Null;
    }

    public function run()
    {
        //Получаем строку запроса
        $uri = $this->getURI();

        //Проверить наличие запроса в роут
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                $segments = explode('/', $path);

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));
                $controlFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controlFile)) {
                    include_once($controlFile);
                }

                $Object = new $controllerName;
                $result = $Object->$actionName();
                if ($result) {
                    break;
                }
            }

        }


    }

}
