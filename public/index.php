<?php
//error_reporting(-1); // all
//echo __FILE__;
//echo $query = //$_SERVER['QUERY_STRING'];
//http://localhost/framework/irina/hello 
// irina/hello

use framework\core\Router;


$query = $_SERVER['QUERY_STRING'];

define('DEBUG', 1);
define('WWW', __DIR__); // public/index
define('CORE', dirname(__DIR__).'/vendor/framework/core'); // vendor/core
define('ROOT', dirname(__DIR__)); // framework
define('LIBS', dirname(__DIR__) . '/vendor/framework/libs');
define('APP', dirname(__DIR__) . '/app'); // app
define ('LAYOUT', 'blog');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('ADMIN', 'http://framework.com/admin');

//var_dump(ROOT);

//require '../vendor/core/Router.php';
require '../vendor/framework/libs/functions.php';
//require '../app/controllers/Main.php';
//require '../app/controllers/Posts.php';
//require '../app/controllers/PostsNew.php';

 /*spl_autoload_register(function($class) {
	//debug($class);
		$file = 
ROOT . '/' . str_replace('\\', '/', $class) . '.php';
//debug($file);
	//$file = APP . "/controllers/$class.php";
//debug($file);
	if(is_file($file)) {
		require_once $file;
	}
}); */


require __DIR__ . '/../vendor/autoload.php';

new \framework\core\App;

//$router = new Router();

// our rules
/*Router::add('posts/add', 
	['controller' => 'Posts', 
	 'action' => 'ad
	]
);
Router::add('posts-new/test-page', 
	['controller' => 'PostsNew', 
	 'action' => 'testPage'
	]
);
Router::add('posts-new/test', 
	['controller' => 'PostsNew', 
	 'action' => 'test'
	]
);

Router::add('posts-new', 
	['controller' => 'PostsNew', 
	 'action' => 'index'
	]
);

Router::add('posts/edit', 
	['controller' => 'Posts', 
	 'action' => 'edit'
	]
);
Router::add('posts/index', 
	['controller' => 'Posts', 
	 'action' => 'index'
	]
);
Router::add('posts/test', 
	['controller' => 'Posts', 
	 'action' => 'test'
	]
);
Router::add(' ', 
	['controller' => 'Main', 
	 'action' => 'index'
	]
);
*/

// !!! правила ПРИОРИТЕТОВ
// конкретные выше, общие ниже


// our rule - to go to another
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller' => 'Page', 
	 //'action' => 'index'
	]);

Router::add('^page/(?P<alias>[a-z-]+)$',['controller' => 'Page', 
	 'action' => 'view'
	]);


// two defaul rules - empty (domen) route
// and all routes (controller+action == posts/
// add)

// for admin panel
Router::add('^admin$', 
	['controller' => 'Main', 
	 'action' => 'index',
	 'prefix' => 'admin'
	]
);

Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', 
	['prefix'=>'admin']);




Router::add('^$', 
	['controller' => 'Main', 
	 'action' => 'index'
	]);

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
	

//debug(Router::getRoutes());

/*if (Router::matchRoute($query)) {
	debug(Router::getRoute());
} else {
	echo "404";
}*/

//Router::matchRoute($query);

Router::dispatch($query);




?>