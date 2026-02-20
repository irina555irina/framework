<?php

namespace app\controllers;

use app\models\Main;

use framework\widgets\menu;

//use Monolog\Level;
//use Monolog\Logger;
//use Monolog\Handler\StreamHandler;

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;


//use framework\libs;
use framework\core\App;
use framework\libs\Pagination;

require_once 'rb.php';

$db = require_once '../config/config_db.php';

\R::setup($db['dsn'], 
$db['user'], $db['pass']);
// not to change table
\R::freeze(true); 
//\R::fancyDebug(true);
  

class MainController extends AppController
{
	// for all actions of this class
	//public $layout = 'main';

	public function indexAction()
	{
		//echo "irina";
		
		//echo "Main::index";
		// from base/Controller
		// just for one action 
		//$this->layout = 'main';
		//$this->view = 'index';

		// for ajax
		// no layout just for data

		

		//передача переменных 
		// в вид
		 //$name = "Irina";
		 /*$this->set([
		 	'name' => $name, 
		 	'hi' => 'Hello'
		 ]);*/
		 //$hi = 'Hello';
		 //$colors = [
		 //	'white' => 'белый',
		 //	'black' => 'чёрный ',
		// ];

		//$this->set
		//(compact('name', 'hi', 'colors'));


		//$model = new Main;
		//$res = $model->query("CREATE 
		//TABLE posts SELECT * FROM framework.authors");
		//var_dump($res);

		//$res = $model->findAll();
		//$res2 = $model->findAll();
		//$res3 = $model->findAll();
		//debug($res);
		//$title = 'PAGE TITLE';
		//$this->set
		//(compact('res'));

		//$res = $model->findOne(
		//'Гоголь', 'surname');
		//'2');
		//$this->set
		//(compact('res'));

		//$data = $model ->findBySql("SELECT * FROM 
		//$model->table ORDER BY id DESC LIMIT 2");
		
		/* $data = $model ->findBySql
		("SELECT * FROM 
		$model->table WHERE 
		surname LIKE ? " , ['%уш%'] ); */

		/* $model = new Main;
		$data = $model->findLike(
			'Ах', 'surname');
		debug($data); */
		
		/* $model = new Main();
		$data = $model->findAll();
		print_r($data); */


		/* $reg = \vendor\core\Registry::instance();
		
		//var_dump($reg);
		$app = \vendor\core\Registry::instance();
        $app->getList();
		$app->cache->go();
		$app->test->go();
		//$app->getList();
		$app->testMe = "vendor\libs\TestMe";
		//$app->testMe->go();
		$app->getList();
 */

		//App::$app->getList();

		/* $model = new Main;
		\R::fancyDebug(true);
		$authors = App::$app->cache->get('authors');
		//var_dump($authors);
		if (!($authors)) {
			$authors = \R::findAll('authors');
			App::$app->cache->set('authors', 
			$authors);
		}
		 */
		
		//echo date('Y-m-d H:i', time());
		//echo '<br>';
		//echo date('Y-m-d H:i', 1712650645);
		//echo '<br>';
		

		//$this->layout = 'main';
	// to send AJAX to testAction
	// controller - Main
		// action - test
		
	// try MONOLOG library

	// create a log channel
	//$log = new Logger('name');
	//$log->pushHandler(new StreamHandler('ROOT/tmp/monolog.log', Level::Warning));

	// add records to the log
	//$log->warning('Foo');
	//$log->error('Bar');

	// phpMailer

		//$mail = new PHPMailer(true);
		//var_dump($mail);

		$model = new Main;
		$total = \R::count('authors');
		$authors = \R::findAll('authors');

		//debug($total);
		//debug($authors[1]['surname']);

		$page  = isset($_GET['page']) ? 
			(int)$_GET['page'] : 1;
		
		$perpage = 3;

		$pagination = new Pagination($page, 
			$perpage, $total);
		//debug($pagination);
		$start = $pagination->getStart();

		$authors = \R::findAll('authors', 
			"LIMIT $start, $perpage");
		
		//debug($authors);
		$this->set(compact('authors', 'pagination', 
			'total'));
		


	}

	public function testAction()
	{
		if ($this->isAjax()) {
			//echo "irina";
			//debug($_POST);
			$model = new Main();
           
			//to send data to Ajax
			/* $data = [
				'answer' => 'Ответ от сервера',
				'code' => 200,
			];
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
 */

			$author = \R::findOne('authors', 
			"id = {$_POST['id']}");
				//debug($author);
				$this->loadView('testAjax', compact('author'));

			die;
		}
		echo "not Ajax";
		//$this->layout = false; // !!!
		
		//echo "Main::test";
		// controller - Main
		// action - test
		//$this->layout = 'test';
		//echo "irina";
		
		



	}

	public function testPageAction()
	{
		//echo "Main::testPage";
	}

	public function before()
	{
		//echo "before";
	}

	
}



?>