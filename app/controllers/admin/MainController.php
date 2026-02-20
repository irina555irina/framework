<?php

namespace app\controllers\admin;


class MainController extends AppController
{
    public function indexAction()
    {
        $authors =\R::findAll('authors');
        $this->set(compact('authors'));
    }
}

