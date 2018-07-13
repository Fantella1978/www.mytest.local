<?php

namespace App\Controllers;

use App\Controller;
use App\Exceptions\E404Exception;
use App\Models\Article;

class News
    extends Controller
{

    protected function actionOne()
    {
        $item = Article::findOneById($_GET['id']);

        if (empty($item)) {
            throw new E404Exception;
        }

        $this->view->item = $item;
        $this->view->display(__DIR__ . '/../../templates/one.php');
    }

}