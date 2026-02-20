<?php

namespace app\controllers;

use app\models\User;
//use Valitron\Validator;

class UserController extends AppController

{
    // регистрация
    public function signupAction()
    {
        if(!empty($_POST)){
            $user = new User();
            $data = $_POST;
            //debug($data);
            $user->load($data);
            //debug($user);
            //debug($_POST);
           
            if( !$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }

            $user->attributes['password'] = 
                password_hash($user->attributes['password'], 
                PASSWORD_DEFAULT);

            if($user->save('user')) {
                $_SESSION['success'] = 'Вы успешно зарегистрированы';
            } else {
                $_SESSION['errors'] = "Ошибка!";
            }
            redirect();
        }
    }

    public function loginAction()
    {
        if(!empty($_POST)){
            $user = new User();
            if($user->login()) {
                $_SESSION['success'] = "Успешно авторизованы";
            } else {
                $_SESSION['errors'] = "Неверно";
            }
            redirect('/');
        }
        
    }

    public function logoutAction()
    {
        if(isset($_SESSION['user']))
         unset($_SESSION['user']);
        redirect('/user/login');
    }
}