<?php

namespace app\controllers\admin;

use framework\core\base\View;
use app\models\User;


class UserController extends AppController
{
    // another layout
    //public $layout = 'default';

    public function indexAction()
    {
        //echo "admin";
        //echo __METHOD__;

        // to send data to view
        $test = "test var";
       $data = ['test', 2];

        /* 1st method
       $this->set([
            'test' => $test,
            'data' => $data,
       ]); 
       */

       // 2nd method
       $this->set(compact('test', 'data' ));


    }

    public function testAction()
    {
        //echo __METHOD__;
        $this->layout = 'default';
    }

    public function loginAction()
    { 
        //echo password_hash("12345", PASSWORD_DEFAULT);
        if(!empty($_POST)) {
            echo "irina";
            $user = new User();
           
            if(!$user->login(true)) {
                $_SESSION['error'] = 'Не верно админ';
            }
            if(User::isAdmin()) {
                redirect(ADMIN);
            } else {
                redirect();
            }
 
        }
        $this->layout = 'login';
    }
}