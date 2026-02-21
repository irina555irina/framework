<?php

namespace framework\core\base;

class View
{
	// текущий маршрут 
	public $route = [];
	// текущий вид
	public $view;
	// текущий шаблон
	public $layout;

	public $scripts = [];

	public function __construct($route, 
		$layout = ' ', $view = ' ' )
	{
		//debug($route);
		//var_dump($layout);
		//var_dump($view);

		$this->route = $route;

		if ($layout === false) {
			$this->layout = false; 
		} else {
			$this->layout = $layout ?: LAYOUT;
		}
		
		$this->view = $view;
	}


	protected function compressPage($buffer)
	{
		//return "Hello World";
		//return $buffer;

		$search = [
			"/(\n)+/",
			"/\r\n+/",
			"/\n(\t)+/",
			"/\n(\ )+/",
			"/\>(\n)+</",
			"/\>\r\n</",
		];

		$replace = [
			"\n",
			"\n",
			"\n",
			"\n",
			'><',
			'><',
		];

		return preg_replace($search, $replace, $buffer);

	}



	// from controller to view
	public function render($vars)
	{
		//debug($this->route);
		$this->route['prefix'] = str_replace('\\', '/', 
			$this->route['prefix']);
		//debug($this->route);

		if (is_array($vars)) {
			extract($vars);
		}
		//debug($vars);
		//debug($this->view);
		$file_view = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";

		// буферизация 
		// чтобы вид не подключался раньше
		// шаблона 
		// что после - складывается в буфер 
		// обмена, не выводя на экран
		//ob_start([$this, 'compressPage']);
		//ob_start('ob_gzhandler');
		ob_start();
		{

			//header("Content-Encoding: gzip");
		if (is_file($file_view)) {
			require $file_view;
		} else {
			//echo "<p>Не найден вид
			//<b>$file_view</b></p>";
			throw new \Exception("<p>Не найден вид
			<b>$file_view</b></p>", 404);
		}

		$content = ob_get_contents();
		}
		ob_clean();

		// очищает буфер об обм ена и 
		// складывает в переменную
		// для использования внутри шаблона
		//$content = ob_get_clean();
		//echo $content;

		if (false !== $this->layout) {
			$file_layout = APP . "/views/layouts/{$this->layout}.php";

		if (is_file($file_layout)) {
			$content = $this->getScript($content);
			//debug($this->scripts);

			$scripts = [];
			if (!empty($this->scripts[0])) {
				$scripts = $this->scripts[0];
			}
			//debug($scripts);

			require $file_layout;
		} else {
			//echo "<p>Не найден шаблон
			//<b>$file_layout</b></p>";
			throw new \Exception("<p>Не найден шаблон
			<b>$file_view</b></p>", 404);
		}
		}
		
	}

	// $content = all view html , go to layout
	protected function getScript($content)
	{
		$pattern = "#<script.*?>.*?</script>#si";
		preg_match_all($pattern, $content, 
			$this->scripts);
		if (!empty($this->scripts)) {
			$content = preg_replace($pattern, ' ', 
			$content);
		}
		return $content;
	}

	public function getPart($file)
	{
		$file = APP . "/views/{$file}.php";

		if (is_file($file)) {
			require_once $file;
		} else {
			echo "File {$file} not found";
		}
	}

}