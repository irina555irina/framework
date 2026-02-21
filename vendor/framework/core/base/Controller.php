<?php

namespace framework\core\base;


abstract class Controller
{
	public $route = [];
	public $view;
	public $layout;

// $route = controller+action

// пользовательские данные   
	public $vars = [];

	public function __construct($route)
	{
		$this->route = $route;
		$this->view = $route['action'];
/*		include 
APP . "/views/{$route['controller']}/{$this->view}.php";
*/
	}

	public function getView()
	{
		//debug($this->view);
		$vObj = new View($this->route, 
			$this->layout, $this->view);
		//debug($vObj);
		$vObj->render($this->vars);
	}


	public function set($vars)
	{
		$this->vars = $vars;
	}

	public function isAjax()
	{
		return isset(
		$_SERVER['HTTP_X_REQUESTED_WITH']) 
		&& $_SERVER['HTTP_X_REQUESTED_WITH'] 
		=== 'XMLHttpRequest';
		
	}

	public function loadView($view, $vars = [])
	{
		extract($vars);
		require 
		APP."/views/{$this->route['controller']}/{$view}.php";

	}

} 

?>