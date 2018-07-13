<?php

class DocsController{
	
	public function actionAll()
	{
		/*
		$article = new NewsModel();
		$article->title = 'Привет!';
		$article->text = 'Привет Текст!';
		
		var_dump ( isset ($article->title) );
		*/
		try {
			$order = Array();
			$order = 
			$article = DocsModel::findAllOrderByColumn('title', 'Вторая новость s');
		} catch (ModelException $e) {
			$view = new View();
			$view->displayErrorAndDie('Ошибка: ' . $e->getMessage());			
		}
		
		if (isset($article)) {
			var_dump($article);
		} else {
			echo 'No $article' . '<br>' . "\n";
		}
		
		/*
		$art = new NewsModel();
		$art->title = 'Сегодня в ' . date('G:i:s');
		$art->text = 'Добавилась запись в ' . date('G:i:s d/m/Y');
		$art->insert();
		
		var_dump($art->id);
		*/
		
		/*
		$art = NewsModel::findOneByPk(14);
		$art->title = 'Сегодня в ' . date('G:i:s');
		$art->text = 'Изменилась запись в ' . date('G:i:s d/m/Y');
		$art->save();
		
		var_dump($art->id); */
		
		die;
		
		/* $article->insert();
		
		
		# var_dump($article->id);
		
		# var_dump(NewsModel::findOneByPk(2));
				
		# var_dump(isset($articel->title));
		# echo $article->id . "<br>\n";
		
		#echo 'OK';
		#die;
		
		#$items = NewsModelTest::getAll();
		#$view = new View();
		#$view->assign('items',$items);
		#$view->display('news/all.php');
		#include __DIR__.'/../views/news/all.php';
		*/
	}
	
	public function actionOne()
	{
		$id = (isset($_GET['id']) AND !empty($_GET['id'])) ? $_GET['id'] : NULL;
		# $paramId = new Params('id');
		try {
			$item = NewsModel::findOneByPk($id);
			$view = new View();
			$view->item = $item;
			$view->display('news/one.php');		
		} catch (ModelException $e) {
			$view = new View();
			$view->displayErrorAndDie('Ошибка: ' . $e->getMessage());			
		}
		#var_dump ($item);
		#die;
		
	}
}
