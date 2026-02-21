<?php
// путь от корня
namespace framework\core;

class Router 
{
	/* public function __construct()
	{
		echo "hello from Router";
	}  */

	//all routers (two default)
	protected static $routes = [];
	//router is now
	protected static $route = [];

	public static function add($regexp, $route = []) 
	{
		self::$routes[$regexp] = $route;
	}        

	public static function getRoutes()
	{
		return self::$routes;
	}

	public static function getRoute()
	{
		return self::$route;
	}

	// сравнивает маршрут с имеющимися
	// находит совпадения
	public static function matchRoute($url)
	{
		foreach (self::$routes as $pattern => $route) {
			
			if (preg_match("#$pattern#i", $url, 
				$matches)) {
				//debug($matches);
				foreach ($matches as $key => $value) {
					if (is_string($key)) {
						$route[$key] = $value;
					}
				}

				//debug($route);

				if (!isset($route['action'])) {
					$route['action'] = 'index';
				}

				// prefix for admin controllers
				if (!isset($route['prefix'])) {
					$route['prefix']= '';
				} else {
					$route['prefix'] .='\\';
				}


				$route['controller'] = 
					self::upperCamelCase
						($route['controller']);
				self::$route = $route;
				//debug($route);
				return true;
			}
		}
		return false;
	}


	// создать объект контроллер и
	// вызвать его метод 

	public static function dispatch($url)
	{
		$url = self::removeQueryString($url);
		// неявный гет-параметр
		// явные после /?..=..   
		//var_dump($url);
		if (self::matchRoute($url)) {
			//echo "OK";
			//$controller = 
			//self::$route['controller'];
			//self::upperCamelCase($controller);
			$controller = 'app\controllers\\'.self::$route['prefix'].self::$route['controller'].'Controller';
//debug(self::$route);
			if (class_exists($controller)) {
				//echo 'ok';
				$cObj = new $controller
					(self::$route);
				$action = self::
				lowerCamelCase(self::$route['action']) . 'Action';

				if (method_exists($cObj, $action)){
						$cObj->$action();
						$cObj->getView();
					} else {
						/* echo "Метод <b>
						$controller::$action <b>
						не найден"; */
						throw new \Exception(
							"Метод <b>
							$controller::$action <b>
							не найден", 404
						);
					}


			} else {
				/* echo "Контроллер 
				<b>$controller</b> не найден";
			 */
			throw new \Exception(
				"Контроллер 
				<b>$controller</b> не найден", 
				404
			);
			}
		} else {
			//http_response_code(404);
			//require '404.html';
			throw new \Exception(
				"Страница не найдена", 
				404
			);
		}
	}



	// заменить posts-new на PostsNew

	protected static function 
		upperCamelCase($name)
	{
		//$name = str_replace( '-', ' ', $name);
		//$name = ucwords($name);
		return str_replace( ' ', '', 
					ucwords(str_replace( '-', ' ', 
						$name)) );

		//debug($name);
	}

	protected static function 
		lowerCamelCase($name)
	{
		return lcfirst(self::upperCamelCase($name));
	}

	protected static function removeQueryString($url) 
	{
		if ($url) {
			$params = explode('&', $url, 2);
			//debug($params);
			if (false === strpos($params[0], 
				'=')) {
				return rtrim($params[0], '/');
			} else {
				return ' ';
			}
		}

		//debug($url);
		return $url;
	}
}