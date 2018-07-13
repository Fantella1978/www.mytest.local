<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;

class Index
    extends Controller
{

    protected function actionDefault()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../templates/default.php');
    }

}