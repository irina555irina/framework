<?php

namespace app\controllers\admin;

use app\Models\User;

use frameworkr\core\base\Controller;

class AppController extends \framework\core\base\Controller
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);

        //if(!isset($is_admin) || $is_admin !== 1) {
        //    die('Access Denied');
        //  header('Location: /');
        //}

        //debug($route, 1);
        if(!User::isAdmin() && $route['action'] != 'login') {
            redirect(ADMIN . '/user/login');
        }

    }
    
}