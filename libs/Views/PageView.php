<?php

class PageView
	extends View
{
	private $pageContent;
	
	public function __construct()
	{
		$pageContent = NULL;
		ob_start();
	}
	
	public function renderPart($part)
	{
		ob_start();
		include_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR . $part);
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	public function pageAddContent(){
		$content = ob_get_contents();
		ob_end_clean();
		$this->pageContent .= $content;
		ob_start();
	}
	
	public function displayPart($part)
	{
		echo $this->renderPart($part);
	}
	
	public function displayPageTop(){
		echo $this->displayPart('top.phtml');
		$this->pageAddContent();
	}
	
	public function displayPageBottom(){
		echo $this->displayPart('bottom.phtml');
		$this->pageAddContent();
	}

	public function renderPage()
	{
		$content = ob_get_contents();
		ob_end_clean();
		return $this->pageContent . $content;
	}
	
	public function displayPage()
	{
		echo $this->renderPage();
	}
}
?>