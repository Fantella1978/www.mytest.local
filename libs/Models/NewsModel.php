<?php

class NewsModel
	extends AbstractModel
{
#	public $id;
#	public $title;
#	public $text;
###############################
#	public $id;
#	public $timeadd;
#	public $monthadd;
#	public $year;
#	public $mon;
#	public $DAY;
#	public $HOUR;
#	public $MINUTE;
#	public $datetime;
#	public $razdel;
#	public $checked;
#	public $author;
#	public $zagl;
#	public $text;
#	public $imgtitle;
#	public $imgtitle_w;
#	public $imgtitle_h;
#	public $AltAuthor;
#	public $AltAuthorEmail;
#	public $AltIst;
#	public $AltIstURL;
#	public $views_1;
#	public $views_2;
#	public $views_sum; 
	
	# protected static $table = 'news_test';
	protected static $table = 'news_news';
	# protected static $class = 'News';
	
	public static function findNewItems($count = 0) {
		$order = Array();
		$order['datetime'] = 'DESC';
		$items = static::findLimitedAndOrderedByColumn($order, 0, $count);
		return $items;		
	}

	public function convertToUtf8()
	{
		foreach ($this->data as $key => $value) {
			if ($key == 'text') {
				$this->data[$key] = iconv('Windows-1251', 'UTF-8' , $value);
			}
		}
		return true;
	}

	private function convertSymbolsFromBase($key)
	{
		if (isset($this->data[$key])) {
			$paterns = Array ('/&lt;/i', '/&gt;/i', '/&quot;/i');
			$replacements = Array ('<', '>', '"');
			$this->data[$key] = preg_replace($paterns, $replacements, $this->data[$key]);
		} else {
			return false;
		}
		return true;		
	}
	
	public function convertTextFromBase()
	{ # Конвертируем поле 'text' при получении из базы
		$this->convertSymbolsFromBase('text');
		
		# Заменяем некоторые моменты
		$paterns = Array (
			#'/http:\/\/www.sector.biz.ua/i',
			'/class="center"/i'
		);
		$replacements = Array (
			#'',
			'class="text-center"'
		);
		$this->text = preg_replace($paterns, $replacements, $this->text);
	}
	
	public function convertZaglFromBase()
	{ # Конвертируем поле 'zagl' при получении из базы
		$this->convertSymbolsFromBase('zagl');
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

	public function prepareToView()
	{
		$this->convertToUtf8();
		$this->convertTextFromBase();
		$this->convertZaglFromBase();
		$this->title = strip_tags($this->zagl);
		$this->short_title = $this->getShortText($this->title, 75);
		$this->short_text = $this->getShortText($this->text, 200);
	}	
}