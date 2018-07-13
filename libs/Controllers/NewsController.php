<?php

class NewsController{

	private $colNewsOnOnePage = 30;
	
	public function actionIndexNewsPage()
	{ # Формируем заглавную страницу новостей, последние 10 новостей
		
		$countAllCheckedNews = NewsModel::countByColumnValue('checked', 1);
		#var_dump($countAllCheckedNews);
		#die;
		$items = NewsModel::findNewItems($this->colNewsOnOnePage);
		foreach ($items as $k => $item) {
			$items[$k] = $this->prepareNewsItemDataToView($item);
		}
		$view = new NewsView();
		$view->items = $items;
		$view->displayItemsInFullWidthContent('news/one_news_on_index.php');
		if ($countAllCheckedNews > $this->colNewsOnOnePage) {
			$view->displayArchiveBtn = true;
			$view->displayAddNewsBtn = true;
			$view->displayIndexButtons();
		}
		return true;
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
		# 
		#.' . '<br>' . "\n";
		
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
	private function prepareNewsItemDataToView($item)
	{
		$item->convertToUtf8();
		$item->convertTextFromBase();
		$item->convertTitleFromBase();
		$item->title = strip_tags($item->title);
		$item->short_title = $this->getShortText($item->title, 75);
		$item->short_text = $this->getShortText($item->text, 200);
		if ($item->img_on_title) {
			$item->img_on_title_url = '/img/news/' . $item->id . '/imgnewstitle.jpg';
		} else {
			$item->img_on_title_url = '/img/noimg2.jpg';
		}
		$item->url = '/computer-news/article_' . $item->id . '.html';
		return $item;
	}	

	private function getShortText($textLong, $length){
		$text = strip_tags($textLong);
		if (mb_strlen($text, 'UTF-8') > $length) {
			$pos = mb_strpos($text, ' ', $length, 'UTF-8');
			if ($pos !== false) {
				$text = mb_substr($text, 0, $pos, 'UTF-8');
				return $text . '...';
			}
		}
		return $text;
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
