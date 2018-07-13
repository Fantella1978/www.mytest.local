<?php

class NewsController{
	
	public function actionIndexNewsPage()
	{ # Формируем заглавную страницу новостей
		$items = NewsModel::findNewItems(10);		
		foreach ($items as $item) {
			$item->prepareToView();
		}
		$view = new View();
		$view->items = $items;
		$view->display('news/all.php');
		
		echo 'Последние 10 новостей.' . '<br>' . "\n";
	}

	public function actionAll()
	{

		try {
			$order = Array();
			$order['views_sum'] = 'DESC';
			$order['datetime'] = 'ASC';
			$items = NewsModel::findLimitedAndOrderedByColumn($order, 5, 10);
			foreach ($items as $item) {
				$item->convertToUtf8();
			}
			$view = new View();
			$view->items = $items;
			$view->display('news/all.php');			
		} catch (ModelException $e) {
			$view = new View();
			$view->displayErrorAndDie(404, 'Ошибка: ' . $e->getMessage());			
		}
		die;
		
		/*
		
		try {
			$item = NewsModel::findOneByColumn('zagl', 'Поздравляем всех женщин с праздником 8 марта');
			$view = new View();
			$view->item = $item;
			$view->display('news/one.php');		
			
		} catch (ModelException $e) {
			$view = new View();
			$view->displayErrorAndDie('Ошибка: ' . $e->getMessage());			
		}
		die;
		
		if (isset($item)) {
			var_dump($item);
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
	public function actionUpdateStep_0()
	{
		echo time();
		return true;
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
			$view->displayErrorAndDie(404, 'Ошибка: ' . $e->getMessage());			
		}
		#var_dump ($item);
		#die;
		
	}

	public function actionUpdateStep_1()
	{
		try {
			$items = NewsModel::findAll();
			foreach ($items as $item) {
				$item->time_add = date('Y-m-d H:i:s', $item->timeadd);
				$item->save();
				echo $item->id . ' - ' . $item->timeadd . ' - ' . $item->time_add . ' - OK ' . '<br>' . "\n";
			}
		} catch (ModelException $e) {
			$view = new View();
			$view->displayErrorAndDie(404, 'Ошибка: ' . $e->getMessage());			
		}
		die;
	}
	
	public function actionUpdateStep_2()
	{
		try {
			$items = NewsModel::findAll();
			foreach ($items as $item) {
				$item->time_publish = $item->time_add;
				$item->save();
				echo $item->id . ' - ' . $item->time_add . ' - ' . $item->time_publish . ' - OK ' . '<br>' . "\n";
			}
		} catch (ModelException $e) {
			$view = new View();
			$view->displayErrorAndDie(404, 'Ошибка: ' . $e->getMessage());			
		}
		die;
	}
	
}
