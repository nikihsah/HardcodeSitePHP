<?php
class Router{

	private $routes;

	public function __construct()
	{

		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);

	}

	// Возращает строку 
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])){
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		//Получаем строку запроса
		$uri = $this->getURI();

		//Проверить наличие запроса в роут
		foreach ($this->routes as $uriPattern => $path) {
			
			if( preg_match("~$uriPattern~", $uri))
			{

				$segments = explode('/', $path);

				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				echo "Класс: $controllerName";
				$actionName = 'action'.ucfirst(array_shift($segments));
				echo "Метод: $actionName";
			}

		}


	}

}





?>